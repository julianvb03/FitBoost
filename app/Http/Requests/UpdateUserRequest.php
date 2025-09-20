<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'email' => 'nullable|string',
            'password' => 'nullable|string',
            'confitm_password' => 'nullable|string|same:password',
            'card_data' => 'nullable|string',
            'address' => 'nullable|string',
            'name' => 'nullable|string',
        ];
    }
}
