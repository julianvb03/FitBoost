<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Category extends Model
{
    /**
     * ITEM ATTRIBUTES.
     * $this->attributes['id']              - int           - contains the int primary key (id)
     * $this->attributes['name']            - string        - contains the category name
     * $this->attributes['description']     - string        - contains the category description
     * $this->supplements                   - Supplement[]  - contains the category supplements
     */
    public $timestamps = false;

    protected $fillable = ['name', 'description'];

    // Getters Section
    public function getId(): int
    {
        return $this->getAttribute('id');
    }

    public function getName(): string
    {
        return $this->getAttribute('name');
    }

    public function getDescription(): string
    {
        return $this->getAttribute('description');
    }

    // Setters Section

    public function setName(string $name): void
    {
        $this->setAttribute('name', $name);
    }

    public function setDescription(string $description): void
    {
        $this->setAttribute('description', $description);
    }

    // Eloquent Relationships
    public function supplements(): BelongsToMany
    {
        return $this->belongsToMany(Supplement::class, 'category_supplement')->withTimestamps();
    }

    public function getSupplements(): Collection
    {
        return $this->supplements;
    }
}
