<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateTestRequest;
use App\Models\Test;
use App\Services\TestService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class TestRecommendationController extends Controller
{
    public function __construct(private readonly TestService $testService) {}

    public function create(): View
    {
        // render create form
        return view('tests.recommendations.create');
    }

    public function store(CreateTestRequest $request): RedirectResponse
    {
        // delegate creation and recommendation to services
        [$test, $supplements, $explanation] = $this->testService->createWithRecommendations(Auth::user(), $request->validated());

        return redirect()->route('tests.recommendations.show', ['id' => $test->getId()])
            ->with('recommendation_explanation', $explanation);
    }

    public function show(int $id): View
    {
        // load test with supplements
        $test = Test::query()->with('supplements')->findOrFail($id);

        return view('tests.recommendations.show', [
            'test' => $test,
            'supplements' => $test->supplements,
            'explanation' => session('recommendation_explanation') ?? null,
        ]);
    }
}
