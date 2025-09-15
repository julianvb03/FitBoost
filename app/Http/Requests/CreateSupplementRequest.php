<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Carbon;
use Exception;

class CreateSupplementRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'laboratory' => 'required|string|max:255',
            'images' => 'required|array',
            'images.*' => 'string|max:255|min:1',
            'price' => 'required|integer|min:0',
            'stock' => 'required|integer|min:0',
            'flavour' => 'required|string|max:255',
            'expiration_date' => 'required|date|after:today',
            'ingredients' => 'required|string',
            'categories' => 'required|array|min:1',
            'categories.*' => 'integer|exists:categories,id',
        ];
    }

    public function prepareForValidation(): void
    {
        $input = $this->all();
        
        if (isset($input['images'])) {
            $input['images'] = array_filter($input['images'] ?? [], function ($value) {
                return !empty(trim($value));
            });
        }
        
        if (isset($input['categories'])) {
            $input['categories'] = array_filter($input['categories'], function ($value) {
                return !empty($value);
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
        
        $this->replace($input);
    }

}
