<?php

namespace App\Http\Requests;

use Exception;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Carbon;

abstract class BaseSupplementRequest extends FormRequest
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
            'laboratory' => 'string|max:255',
            'images' => 'array',
            'images.*' => 'string|max:255|min:1',
            'price' => 'integer|min:0',
            'stock' => 'integer|min:0',
            'flavour' => 'string|max:255',
            'expiration_date' => 'date|after:today',
            'ingredients' => 'string',
            'categories' => 'array|min:1',
            'categories.*' => 'integer|exists:categories,id',
        ];
    }

    public function prepareForValidation(): void
    {
        $input = $this->all();

        if (isset($input['images'])) {
            $input['images'] = array_filter($input['images'] ?? [], function ($value) {
                return ! empty(trim($value));
            });
        }

        if (isset($input['categories'])) {
            $input['categories'] = array_filter($input['categories'], function ($value) {
                return ! empty($value);
            });
        }

        if (isset($input['expiration_date'])) {
            try {
                $date = Carbon::parse($input['expiration_date']);
                $input['expiration_date'] = $date->format('Y-m-d');
            } catch (Exception $e) {
                // If failed, do nothing and keep the original value for fail on validation time
            }
        }

        $filteredInput = array_filter($input, function ($value) {
            return $value !== null && $value !== '';
        });

        $this->replace($filteredInput);
    }

    public function messages(): array
    {
        return [
            'name.required' => trans('admin/admin.validation.name.required'),
            'description.required' => trans('admin/admin.validation.description.required'),
            'laboratory.required' => trans('admin/admin.validation.laboratory.required'),
            'price.required' => trans('admin/admin.validation.price.required'),
            'price.integer' => trans('admin/admin.validation.price.integer'),
            'price.min' => trans('admin/admin.validation.price.min'),
            'stock.required' => trans('admin/admin.validation.stock.required'),
            'stock.integer' => trans('admin/admin.validation.stock.integer'),
            'stock.min' => trans('admin/admin.validation.stock.min'),
            'flavour.required' => trans('admin/admin.validation.flavour.required'),
            'expiration_date.required' => trans('admin/admin.validation.expiration_date.required'),
            'expiration_date.date' => trans('admin/admin.validation.expiration_date.date'),
            'expiration_date.after' => trans('admin/admin.validation.expiration_date.after'),
            'ingredients.required' => trans('admin/admin.validation.ingredients.required'),
            'categories.required' => trans('admin/admin.validation.categories.required'),
            'categories.min' => trans('admin/admin.validation.categories.min'),
        ];
    }
}
