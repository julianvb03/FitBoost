<?php

namespace App\Http\Requests;

class CreateSupplementRequest extends BaseSupplementRequest
{
    public function rules(): array
    {
        $rules = $this->baseRules();

        foreach ($rules as $field => $rule) {
            if ($field !== 'images.*' && $field !== 'categories.*') {
                $rules[$field] = 'required|'.$rule;
            }
        }

        return $rules;
    }
}
