<?php

namespace App\Util;

class BmiMath
{
    public static function calculateFromMetric(float $weightKg, float $heightCm): float
    {
        $heightMeters = max(0.01, $heightCm / 100);

        return $weightKg / ($heightMeters * $heightMeters);
    }

    public static function calculateFromImperial(float $weightLbs, float $heightInches): float
    {
        if ($heightInches <= 0) {
            return 0.0;
        }

        return (703 * $weightLbs) / ($heightInches * $heightInches);
    }

    public static function categorize(float $bmi): string
    {
        return match (true) {
            $bmi < 18.5 => trans('bmi.categories.underweight'),
            $bmi < 25 => trans('bmi.categories.normal'),
            $bmi < 30 => trans('bmi.categories.overweight'),
            $bmi < 35 => trans('bmi.categories.obesity_class_1'),
            $bmi < 40 => trans('bmi.categories.obesity_class_2'),
            default => trans('bmi.categories.obesity_class_3'),
        };
    }
}
