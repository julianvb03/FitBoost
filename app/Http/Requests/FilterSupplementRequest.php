<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FilterSupplementRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'search' => 'nullable|string|max:255',
            'category_id' => 'nullable|integer|exists:categories,id',
            'order_by' => 'nullable|string|in:name,price,rating',
            'query' => 'nullable|string|max:255',
            'min_price' => 'nullable|integer|min:0',
            'max_price' => 'nullable|integer|min:0',
            'in_stock' => 'nullable|integer|in:0,1',
            'per_page' => 'nullable|integer|min:1|max:100',
            'page' => 'nullable|integer|min:1',
        ];
    }

    public function prepareForValidation(): void
    {

        $this->merge([
            'per_page' => $this->per_page ?? 4,
            'page' => $this->page ?? 1,
        ]);

        $input = $this->all();

        $filteredInput = array_filter($input, function ($value) {
            return $value !== null && $value !== '';
        });

        $this->replace($filteredInput);
    }
}
