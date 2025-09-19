<?php

namespace App\Http\Requests;

class CreateSupplementRequest extends BaseSupplementRequest
{
    public function rules(): array
    {
        $rules = $this->baseRules();

        foreach ($rules as $field => $rule) {
            if ($field !== 'categories.*' && $field !== 'image' && $field !== 'image_path') {
                $rules[$field] = 'required|'.$rule;
            }
        }

        return $rules;
    }
}
