<?php

namespace App\Http\Requests;

class CreateCategoryResquest extends BaseCategoryResquest
{
    public function rules(): array
    {
        $rules = $this->baseRules();

        foreach ($rules as $field => $rule) {
            $rules[$field] = 'required|'.$rule;
        }

        return $rules;
    }
}
