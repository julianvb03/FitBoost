<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Category extends Model
{
    /**
     * ITEM ATTRIBUTES.
     * $this->attributes['name'] - string - contains the category name
     * $this->attributes['description'] - string - contains the category description
     * $this->attributes['supplements'] - Supplement[] - contains the category supplements
     */
    protected $fillable = ['name', 'description'];

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
}
