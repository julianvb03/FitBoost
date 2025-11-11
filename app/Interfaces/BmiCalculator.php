<?php

namespace App\Interfaces;

use App\DTO\BmiCalculationInput;
use App\DTO\BmiCalculationResult;

interface BmiCalculator
{
    public function calculate(BmiCalculationInput $input): BmiCalculationResult;
}
