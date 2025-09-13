<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    /**
     * Category attributes that are mass assignable.
     * $this->attributes['name'] = 'name';
     * $this->attributes['description'] = 'description';
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
    /*
    public function supplements(): HasMany
    {
        return $this->hasMany(Supplement::class);
    }

    public function getSupplements(): Collection
    {
        return $this->supplements;
    }

    public function setSupplements(Collection $supplements): void
    {
        $this->supplements = $supplements;
    }
    */
}
