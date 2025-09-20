<?php

declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

final class AddToCartRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'supplement_id' => ['required', 'integer', 'exists:supplements,id'],
            'quantity' => ['required', 'integer', 'min:1', 'max:99'],
        ];
    }

    public function getSupplementId(): int
    {
        /** @var int */
        $id = (int) $this->input('supplement_id');

        return $id;
    }

    public function getQuantity(): int
    {
        /** @var int */
        $qty = (int) $this->input('quantity', 1);

        return $qty;
    }
}
