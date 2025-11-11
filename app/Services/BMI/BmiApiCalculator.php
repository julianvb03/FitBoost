<?php

namespace App\Services\BMI;

use App\DTO\BmiCalculationInput;
use App\DTO\BmiCalculationResult;
use App\Exceptions\BmiCalculationException;
use App\Interfaces\BmiCalculator;
use App\Util\BmiMath;
use App\Util\UnitConverter;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Throwable;

class BmiApiCalculator implements BmiCalculator
{
    public function __construct(private readonly array $config) {}

    public function calculate(BmiCalculationInput $input): BmiCalculationResult
    {
        $apiKey = data_get($this->config, 'key');
        $host = data_get($this->config, 'host');
        $baseUrl = rtrim((string) data_get($this->config, 'base_url', ''), '/');
        $timeout = (int) data_get($this->config, 'timeout', 10);

        if (! $apiKey || ! $host || empty($baseUrl)) {
            throw new BmiCalculationException(trans('bmi.config_error'), 'error');
        }

        $endpoint = '/api/BMI/imperial';
        $payload = $input->isImperial()
            ? [
                'lbs' => UnitConverter::format($input->weight()),
                'inches' => UnitConverter::format($input->height()),
            ]
            : [
                'lbs' => UnitConverter::format(UnitConverter::kilogramsToPounds($input->weight())),
                'inches' => UnitConverter::format(UnitConverter::centimetersToInches($input->height())),
            ];

        try {
            $response = Http::withHeaders([
                'x-rapidapi-key' => $apiKey,
                'x-rapidapi-host' => $host,
            ])->timeout($timeout)->get($baseUrl.$endpoint, $payload);
        } catch (Throwable $exception) {
            Log::warning('BMI API request failed', ['message' => $exception->getMessage()]);
            throw new BmiCalculationException(trans('bmi.api_error_fallback'), 'warning', $exception);
        }

        if (! $response->successful()) {
            Log::warning('BMI API responded with error', [
                'status' => $response->status(),
                'body' => $response->body(),
            ]);

            throw new BmiCalculationException(trans('bmi.api_error_fallback'));
        }

        $body = $response->json();
        $bmiValue = data_get($body, 'bmi') ?? data_get($body, 'BMI');

        if (! is_numeric($bmiValue)) {
            $bmiValue = BmiMath::calculateFromImperial((float) $payload['lbs'], (float) $payload['inches']);
        }

        $category = data_get($body, 'health') ?? data_get($body, 'Health');
        $category ??= data_get($body, 'bmiCategoryForAdults.category');
        $category ??= BmiMath::categorize((float) $bmiValue);

        $range = data_get($body, 'healthy_bmi_range') ?? data_get($body, 'Healthy BMI Range');
        $range ??= trans('bmi.default_range');

        return new BmiCalculationResult((float) $bmiValue, (string) $category, (string) $range, 'api');
    }
}
