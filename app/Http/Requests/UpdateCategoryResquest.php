<?php

namespace App\Http\Requests;

class UpdateCategoryResquest extends BaseCategoryResquest
{
    public function rules(): array
    {
        $rules = $this->baseRules();

        foreach ($rules as $field => $rule) {
            $rules[$field] = 'nullable|'.$rule;
        }

        return $rules;
    }
}
