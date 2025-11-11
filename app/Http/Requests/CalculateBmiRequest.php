<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CalculateBmiRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $system = $this->input('system', 'metric');
        $weightMax = $system === 'imperial' ? 900 : 400;
        $heightMin = $system === 'imperial' ? 36 : 80;
        $heightMax = $system === 'imperial' ? 110 : 250;

        return [
            'system' => 'required|in:metric,imperial',
            'weight' => "required|numeric|min:1|max:{$weightMax}",
            'height' => "required|numeric|min:{$heightMin}|max:{$heightMax}",
        ];
    }

    public function attributes(): array
    {
        return [
            'system' => trans('bmi.attributes.system'),
            'weight' => trans('bmi.attributes.weight'),
            'height' => trans('bmi.attributes.height'),
        ];
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'weight' => $this->normalizeDecimal($this->input('weight')),
            'height' => $this->normalizeDecimal($this->input('height')),
        ]);
    }

    private function normalizeDecimal(?string $value): ?string
    {
        if ($value === null) {
            return null;
        }

        return str_replace(',', '.', (string) $value);
    }
}
