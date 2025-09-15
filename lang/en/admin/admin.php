<?php

return [

    /**
     * Admin Language Lines
     */

    'success_supplement_created' => 'Supplement created successfully',
    'success_supplement_deleted' => 'Supplement deleted successfully',
    'failed_supplement_not_found' => 'Supplement not found',
    'success_supplement_updated' => 'Supplement updated successfully',

    // Validation messages for creating/updating supplements
    'validation.name.required' => 'The supplement name is required',
    'validation.description.required' => 'The description is required',
    'validation.laboratory.required' => 'The laboratory is required',
    'validation.price.required' => 'The price is required',
    'validation.price.integer' => 'The price must be an integer',
    'validation.price.min' => 'The price must be greater than or equal to zero',
    'validation.stock.required' => 'The stock is required',
    'validation.stock.integer' => 'The stock must be an integer',
    'validation.stock.min' => 'The stock must be greater than or equal to zero',
    'validation.flavour.required' => 'The flavour is required',
    'validation.expiration_date.required' => 'The expiration date is required',
    'validation.expiration_date.date' => 'The expiration date must be a valid date',
    'validation.expiration_date.after' => 'The expiration date must be after today',
    'validation.ingredients.required' => 'The ingredients are required',
    'validation.categories.required' => 'You must select at least one category',
    'validation.categories.min' => 'You must select at least one category',
];