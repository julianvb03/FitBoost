<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Carbon;
use Exception;

class UpdateSupplementRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'sometimes|required|string|max:255',
            'description' => 'sometimes|required|string',
            'laboratory' => 'sometimes|required|string|max:255',
            'images' => 'sometimes|array',
            'images.*' => 'string|max:255|min:1',
            'price' => 'sometimes|required|integer|min:0',
            'stock' => 'sometimes|required|integer|min:0',
            'flavour' => 'sometimes|required|string|max:255',
            'expiration_date' => 'sometimes|required|date|after:today',
            'ingredients' => 'sometimes|required|string',
            'categories' => 'sometimes|required|array|min:1',
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
                $input['expiration_date'] = Carbon::parse($input['expiration_date']);
            } catch (Exception $e) {
                // If failed, do nothing and keep the original value for fail on validation time
            }
        }
        
        $this->replace($input);
    }

    /**
     * Get custom messages for validator errors.
     */
    public function messages(): array
    {
        return [
            'name.required' => 'El nombre del suplemento es obligatorio',
            'description.required' => 'La descripción es obligatoria',
            'laboratory.required' => 'El laboratorio es obligatorio',
            'price.required' => 'El precio es obligatorio',
            'price.integer' => 'El precio debe ser un número entero',
            'price.min' => 'El precio debe ser mayor o igual a cero',
            'stock.required' => 'El stock es obligatorio',
            'stock.integer' => 'El stock debe ser un número entero',
            'stock.min' => 'El stock debe ser mayor o igual a cero',
            'flavour.required' => 'El sabor es obligatorio',
            'expiration_date.required' => 'La fecha de vencimiento es obligatoria',
            'expiration_date.date' => 'La fecha de vencimiento debe ser una fecha válida',
            'expiration_date.after' => 'La fecha de vencimiento debe ser posterior a hoy',
            'ingredients.required' => 'Los ingredientes son obligatorios',
            'categories.required' => 'Debe seleccionar al menos una categoría',
            'categories.min' => 'Debe seleccionar al menos una categoría',
        ];
    }
}