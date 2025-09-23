<?php

return [

    /**
     * Admin Language Lines
     */
    'success_supplement_created' => 'Suplemento creado exitosamente',
    'success_supplement_deleted' => 'Suplemento eliminado exitosamente',
    'failed_supplement_not_found' => 'Suplemento no encontrado',
    'success_supplement_updated' => 'Suplemento actualizado correctamente',
    'success_category_created' => 'Categoría creada exitosamente',
    'category_not_found' => 'Categoría no encontrada',
    'success_category_updated' => 'Categoría actualizada correctamente',
    'success_category_deleted' => 'Categoría eliminada exitosamente',

    // Validation messages for creating/updating supplements and categories
    'validation.name.required' => 'El nombre es obligatorio',
    'validation.description.required' => 'La descripción es obligatoria',
    'validation.laboratory.required' => 'El laboratorio es obligatorio',
    'validation.price.required' => 'El precio es obligatorio',
    'validation.price.integer' => 'El precio debe ser un número entero',
    'validation.price.min' => 'El precio debe ser mayor o igual a cero',
    'validation.stock.required' => 'El stock es obligatorio',
    'validation.stock.integer' => 'El stock debe ser un número entero',
    'validation.stock.min' => 'El stock debe ser mayor o igual a cero',
    'validation.flavour.required' => 'El sabor es obligatorio',
    'validation.expiration_date.required' => 'La fecha de vencimiento es obligatoria',
    'validation.expiration_date.date' => 'La fecha de vencimiento debe ser una fecha válida',
    'validation.expiration_date.after' => 'La fecha de vencimiento debe ser posterior a hoy',
    'validation.ingredients.required' => 'Los ingredientes son obligatorios',
    'validation.categories.required' => 'Debe seleccionar al menos una categoría',
    'validation.categories.min' => 'Debe seleccionar al menos una categoría',
];
