<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

abstract class BaseCategoryResquest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    protected function baseRules(): array
    {
        return [
            'name' => 'string|max:255',
            'description' => 'string',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => trans('admin/admin.validation.name.required'),
            'description.required' => trans('admin/admin.validation.description.required'),

        ];
    }
}
