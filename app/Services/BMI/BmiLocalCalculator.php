<?php

namespace App\Services\BMI;

use App\DTO\BmiCalculationInput;
use App\DTO\BmiCalculationResult;
use App\Interfaces\BmiCalculator;
use App\Util\BmiMath;

class BmiLocalCalculator implements BmiCalculator
{
    public function calculate(BmiCalculationInput $input): BmiCalculationResult
    {
        $bmi = $input->isMetric()
            ? BmiMath::calculateFromMetric($input->weight(), $input->height())
            : BmiMath::calculateFromImperial($input->weight(), $input->height());

        $category = BmiMath::categorize($bmi);

        return new BmiCalculationResult(
            $bmi,
            $category,
            trans('bmi.default_range'),
            'local'
        );
    }
}
