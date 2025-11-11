<?php

namespace App\Http\Controllers;

use App\DTO\BmiCalculationInput;
use App\Exceptions\BmiCalculationException;
use App\Http\Requests\CalculateBmiRequest;
use App\Interfaces\BmiCalculator;
use App\ViewModels\BmiViewModel;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class BMIController extends Controller
{
    public function __construct(private readonly BmiCalculator $calculator) {}

    public function index(): View
    {
        $viewData = [];
        $viewData['result'] = null;
        $viewData['message'] = null;
        $viewData['message_level'] = null;
        $viewData['form'] = [
            'system' => 'metric',
            'weight' => null,
            'height' => null,
        ];

        if ($sessionData = session('viewData')) {
            $viewData = array_replace_recursive($viewData, $sessionData);
        }

        $viewData = BmiViewModel::make($viewData, session()->getOldInput());

        return view('bmi.index', ['viewData' => $viewData]);
    }

    public function calculate(CalculateBmiRequest $request): RedirectResponse
    {
        $validated = $request->validated();
        $input = BmiCalculationInput::fromArray($validated);

        $viewData = [];
        $viewData['form'] = [
            'system' => $input->system(),
            'weight' => $input->weight(),
            'height' => $input->height(),
        ];

        try {
            $result = $this->calculator->calculate($input);
            $viewData['result'] = $result->toArray();

            if ($result->message()) {
                $viewData['message'] = $result->message();
                $viewData['message_level'] = $result->messageLevel();
            }
        } catch (BmiCalculationException $exception) {
            $viewData['message'] = $exception->userMessage();
            $viewData['message_level'] = $exception->level();
        }

        return redirect()
            ->route('bmi.index')
            ->withInput($validated)
            ->with('viewData', $viewData);
    }
}
