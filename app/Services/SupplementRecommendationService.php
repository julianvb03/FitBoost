<?php

namespace App\Services;

use App\Models\Supplement;
use App\Models\Test;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Throwable;

class SupplementRecommendationService
{
    public function recommendTop5(Test $test): array
    {
        $candidates = Supplement::query()
            ->where('stock', '>', 0)
            ->select(['id', 'name', 'stock'])
            ->get();

        $heightM = max(0.01, ((int) $test->getHeight()) / 100);
        $bmi = round(((int) $test->getWeight()) / ($heightM * $heightM), 1);

        $payload = [
            'goals' => $test->getGoals(),
            'context' => $test->getContext(),
            'routine' => $test->getRoutine(),
            'diet' => $test->getDiet(),
            'weight' => $test->getWeight(),
            'height' => $test->getHeight(),
            'bmi' => $bmi,
            'candidates' => $candidates->take(50)->map(fn ($c) => ['id' => $c->getId(), 'name' => $c->getName()])->all(),
            'expected_output' => [
                'selected_ids' => '[int,int,... up to 5]',
                'explanation' => 'string concise',
            ],
        ];

        $selectedIds = [];
        $explanation = '';

        $apiKey = config('services.openai.api_key');
        $debugDummy = (bool) config('services.openai.debug_dummy', false);
        if ($apiKey) {
            try {
                Log::info('OpenAI call start', [
                    'has_key' => (bool) $apiKey,
                    'candidates' => $candidates->count(),
                ]);

                $messages = [
                    [
                        'role' => 'system',
                        'content' => 'Eres un asistente de tienda fitness. Devuelve SOLO JSON (response_format=json_object) con las claves: selected_ids (int[]) y explanation (string en español). La explanation debe: 1) repetir los datos del usuario (peso kg, altura cm y BMI calculado si se entrega), 2) mencionar sus goals, 3) sugerir el tipo de ejercicio más adecuado de forma breve, 4) justificar en 1-2 frases por qué los suplementos elegidos encajan. Sé conciso y evita listas.',
                    ],
                    [
                        'role' => 'user',
                        'content' => json_encode($payload),
                    ],
                ];

                $requestBody = [
                    'model' => 'gpt-4o-mini',
                    'messages' => $messages,
                    'max_tokens' => 300,
                    'temperature' => 0.3,
                    'response_format' => ['type' => 'json_object'],
                ];

                $attempts = 0;
                while ($attempts < 2 && empty($selectedIds)) {
                    $attempts++;
                    $response = Http::withToken($apiKey)
                        ->timeout(20)
                        ->post('https://api.openai.com/v1/chat/completions', $requestBody);

                    if ($response->successful()) {
                        $content = data_get($response->json(), 'choices.0.message.content');
                        Log::info('OpenAI response', ['len' => strlen((string) $content)]);

                        $decoded = json_decode((string) $content, true);
                        if (! is_array($decoded)) {
                            if (preg_match('/\{[\s\S]*\}/', (string) $content, $m)) {
                                $decoded = json_decode($m[0], true);
                            }
                        }

                        if (is_array($decoded)) {
                            $selectedIds = array_slice(array_map('intval', $decoded['selected_ids'] ?? []), 0, 5);
                            $explanation = (string) ($decoded['explanation'] ?? '');
                        } else {
                            Log::warning('OpenAI parse failed', ['content' => $content]);
                        }
                    } else {
                        Log::warning('OpenAI HTTP error', ['status' => $response->status(), 'body' => $response->body()]);
                    }
                }
            } catch (Throwable $e) {
                Log::error('OpenAI error', ['error' => $e->getMessage()]);
            }
        }

        if ($debugDummy && empty($selectedIds)) {
            $selectedIds = $candidates->pluck('id')->shuffle()->take(5)->map(fn ($id) => (int) $id)->all();
            $explanation = 'Dummy debug: random top 5 to validate UI flow.';
        }

        if (empty($selectedIds)) {
            $selectedIds = $candidates->sortByDesc(fn ($s) => $s->getStock())
                ->take(5)
                ->pluck('id')
                ->map(fn ($id) => (int) $id)
                ->all();
            $explanation = $explanation ?: 'Based on availability and your goals, these supplements fit best.';
        }

        $supplements = Supplement::query()->whereIn('id', $selectedIds)->get();

        return [
            'supplements' => $supplements,
            'explanation' => $explanation,
        ];
    }
}
