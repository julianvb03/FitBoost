<?php

namespace App\Util;

class UnitConverter
{
    public static function kilogramsToPounds(float $kilograms): float
    {
        return $kilograms * 2.2046226218;
    }

    public static function centimetersToInches(float $centimeters): float
    {
        return $centimeters / 2.54;
    }

    public static function poundsToKilograms(float $pounds): float
    {
        return $pounds / 2.2046226218;
    }

    public static function inchesToCentimeters(float $inches): float
    {
        return $inches * 2.54;
    }

    public static function format(float $value, int $precision = 2): string
    {
        return number_format($value, $precision, '.', '');
    }
}
