<?php

namespace App\Http\Requests;

class UpdateSupplementRequest extends BaseSupplementRequest
{
    public function rules(): array
    {
        $rules = $this->baseRules();

        foreach ($rules as $field => $rule) {
            if ($field !== 'categories.*') {
                $rules[$field] = 'nullable|' . $rule;
            }
        }

        $rules['remove_image'] = 'nullable|boolean';

        return $rules;
    }
}
