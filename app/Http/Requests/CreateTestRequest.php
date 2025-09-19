<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateTestRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check();
    }

    public function rules(): array
    {
        return [
            'context' => ['required', 'string', 'max:255'],
            'routine' => ['required', 'string', 'max:255'],
            'diet' => ['required', 'string', 'max:255'],
            'weight' => ['required', 'integer', 'min:1', 'max:500'],
            'height' => ['required', 'integer', 'min:30', 'max:300'],
            'goals' => ['required', 'array', 'min:1'],
            'goals.*' => ['string', 'max:255'],
            'responses' => ['required', 'array', 'min:1'],
            'responses.*' => ['string', 'max:1000'],
        ];
    }
}
