<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SupplementDetailResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        $supplement = $this->resource;

        $expirationDate = $supplement->getAttribute('expiration_date');

        return [
            'id' => $supplement->getAttribute('id'),
            'name' => $supplement->getAttribute('name'),
            'description' => $supplement->getAttribute('description'),
            'laboratory' => $supplement->getAttribute('laboratory'),
            'price' => $supplement->getAttribute('price'),
            'stock' => $supplement->getAttribute('stock'),
            'flavour' => $supplement->getAttribute('flavour'),
            'expiration_date' => $expirationDate?->toISOString(),
            'ingredients' => $supplement->getAttribute('ingredients'),
        ];
    }
}
