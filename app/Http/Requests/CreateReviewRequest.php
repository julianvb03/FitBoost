<?php

namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;

class CreateReviewRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'supplement_id' => 'required|int|exists:supplements,id',
            'rating' => 'required|int|min:1|max:5',
            'comment' => 'required|string|max:1000',
        ];
    }
}