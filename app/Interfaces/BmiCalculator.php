<?php

namespace App\Interfaces;

use App\DTO\BmiCalculationInput;
use App\DTO\BmiCalculationResult;
use App\Exceptions\BmiCalculationException;

interface BmiCalculator
{
    public function calculate(BmiCalculationInput $input): BmiCalculationResult;
}
