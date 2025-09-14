<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Collection;

class Category extends Model
{
    /**
     * ITEM ATTRIBUTES.
     * $this->attributes['id']              - int           - contains the int primary key (id)
     * $this->attributes['name']            - string        - contains the category name
     * $this->attributes['description']     - string        - contains the category description
     * $this->supplements                   - Supplement[]  - contains the category supplements
     */

    protected $fillable = ['name', 'description'];

    // Getters Section
    public function getId(): int
    {
        return $this->attributes['id'];
    }

    public function getName(): string
    {
        return $this->attributes['name'];
    }

    public function getDescription(): string
    {
        return $this->attributes['description'];
    }

    // Setters Section

    public function setName(string $name): void
    {
        $this->attributes['name'] = $name;
    }

    public function setDescription(string $description): void
    {
        $this->attributes['description'] = $description;
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
