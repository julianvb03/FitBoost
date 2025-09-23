<?php

namespace App\Services;

use App\Models\Test;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class TestService
{
    public function __construct(private readonly SupplementRecommendationService $recommendationService) {}

    /**
     * Create a Test for user, request data already validated, and attach recommendations.
     * Returns array: [Test $test, array $supplements, string $explanation]
     */
    public function createWithRecommendations(User $user, array $data): array
    {
        return DB::transaction(function () use ($user, $data) {
            $test = new Test;
            $test->setUserId($user->getId());
            $test->setContext($data['context']);
            $test->setRoutine($data['routine']);
            $test->setDiet($data['diet']);
            $test->setWeight((int) $data['weight']);
            $test->setHeight((int) $data['height']);
            $test->setGoals($data['goals']);
            $test->setResponses($data['responses']);
            $test->setStatus('completed');
            $test->save();

            [$supplements, $explanation] = (function () use ($test) {
                $result = $this->recommendationService->recommendTop5($test);

                return [$result['supplements'], $result['explanation']];
            })();

            // Attach to pivot (no extra columns per Option A)
            $test->supplements()->sync($supplements->pluck('id')->all());

            return [$test, $supplements, $explanation];
        });
    }
}
