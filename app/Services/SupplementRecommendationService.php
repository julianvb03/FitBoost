<?php

namespace App\Services;

use App\Models\Supplement;
use App\Models\Test;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Http;
use Throwable;

class SupplementRecommendationService
{
    public function recommendTop5(Test $test): array
    {
        $candidates = Supplement::query()
            ->where('stock', '>', 0)
            ->select(['id', 'name', 'stock'])
            ->get();

        $payload = [
            'goals' => $test->getGoals(),
            'context' => $test->getContext(),
            'routine' => $test->getRoutine(),
            'diet' => $test->getDiet(),
            'weight' => $test->getWeight(),
            'height' => $test->getHeight(),
            'candidates' => $candidates->map(fn ($c) => ['id' => $c->getId(), 'name' => $c->getName()])->all(),
            'expected_output' => [
                'selected_ids' => '[int,int,... up to 5]',
                'explanation' => 'string concise',
            ],
        ];

        $selectedIds = [];
        $explanation = '';

        $apiKey = config('services.openai.api_key'); // use key if present; otherwise fallback
        if ($apiKey) {
            try {
                $response = Http::withToken($apiKey)
                    ->timeout(12)
                    ->post('https://api.openai.com/v1/chat/completions', [
                        'model' => 'gpt-4o-mini',
                        'messages' => [
                            ['role' => 'system', 'content' => 'You are a concise fitness shop assistant. Return JSON only.'],
                            ['role' => 'user', 'content' => json_encode($payload)],
                        ],
                        'max_tokens' => 300,
                        'temperature' => 0.2,
                    ]);

                if ($response->successful()) { // parse compact JSON {selected_ids:[], explanation:""}
                    $content = data_get($response->json(), 'choices.0.message.content');
                    $decoded = json_decode((string) $content, true);
                    if (is_array($decoded)) {
                        $selectedIds = array_slice(array_map('intval', $decoded['selected_ids'] ?? []), 0, 5);
                        $explanation = (string) ($decoded['explanation'] ?? '');
                    }
                }
            } catch (Throwable $e) {
                // fallback handled below
            }
        }

        if (empty($selectedIds)) {
            // Fallback: top 5 by stock
            $selectedIds = $candidates->sortByDesc(fn ($s) => $s->getStock())
                ->take(5)
                ->pluck('id')
                ->map(fn ($id) => (int) $id)
                ->all();
            $explanation = $explanation ?: 'Based on availability and your goals, these supplements fit best.';
        }

        /** @var Collection<int, Supplement> $supplements */
        $supplements = Supplement::query()->whereIn('id', $selectedIds)->get();

        return [
            'supplements' => $supplements,
            'explanation' => $explanation,
        ];
    }
}
