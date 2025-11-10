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

        $viewData = [];
        $viewData['recommendation_explanation'] = $explanation;

        return redirect()->route('tests.recommendations.show', ['id' => $test->getId()])
            ->with('viewData', $viewData);
    }

    public function show(int $id): View
    {
        // load test with supplements
        $test = Test::query()->with('supplements')->findOrFail($id);

        $viewData = [];
        $viewData['test'] = $test;
        $viewData['supplements'] = $test->supplements;

        if (session('viewData')) {
            $sessionViewData = session('viewData');
            if (isset($sessionViewData['recommendation_explanation'])) {
                $viewData['explanation'] = $sessionViewData['recommendation_explanation'];
            }
        }

        return view('tests.recommendations.show')->with('viewData', $viewData);
    }
}
