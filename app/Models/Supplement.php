<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Carbon;

/**
 * SUPPLEMENT ATTRIBUTES
 * $this->attributes['id']               - int       - primary key (id)
 * $this->attributes['name']             - string    - supplement name
 * $this->attributes['description']      - string    - detailed description
 * $this->attributes['laboratory']       - string    - manufacturer or laboratory name
 * $this->attributes['image_path']       - string    - path to the product image
 * $this->attributes['price']            - int       - price (unsigned integer)
 * $this->attributes['stock']            - int       - available quantity (unsigned integer)
 * $this->attributes['flavour']          - string    - flavour of the supplement
 * $this->attributes['expiration_date']  - date      - expiration date
 * $this->attributes['ingredients']      - string    - description of the ingredients
 * $this->attributes['created_at']       - timestamp - creation date
 * $this->attributes['updated_at']       - timestamp - update date
 * $this->reviews                        - Review[]  - contains the supplement's reviews
 * $this->items                          - Item[]    - contains the supplement's items
 * $this->tests                          - Test[]    - contains the supplement's tests
 * $this->categories                     - Category[] - belongs to category (FK planned)
 */
final class Supplement extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'laboratory',
        'image_path',
        'price',
        'stock',
        'flavour',
        'expiration_date',
        'ingredients',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
        'items',
    ];

    protected function casts(): array
    {
        return [
            'price' => 'integer',
            'stock' => 'integer',
            'expiration_date' => 'date',
        ];
    }

    // Getters

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

    public function getLaboratory(): string
    {
        return $this->getAttribute('laboratory');
    }

    public function getImagePath(): ?string
    {
        return $this->getAttribute('image_path');
    }

    public function getPrice(): int
    {
        return $this->getAttribute('price');
    }

    public function getStock(): int
    {
        return $this->getAttribute('stock');
    }

    public function getFlavour(): string
    {
        return $this->getAttribute('flavour');
    }

    public function getExpirationDate(): Carbon
    {
        return $this->getAttribute('expiration_date');
    }

    public function getIngredients(): string
    {
        return $this->getAttribute('ingredients');
    }

    public function getCreatedAt(): Carbon
    {
        return $this->getAttribute('created_at');
    }

    public function getUpdatedAt(): Carbon
    {
        return $this->getAttribute('updated_at');
    }

    // Setters
    public function setName(string $name): void
    {
        $this->setAttribute('name', $name);
    }

    public function setDescription(string $description): void
    {
        $this->setAttribute('description', $description);
    }

    public function setLaboratory(string $laboratory): void
    {
        $this->setAttribute('laboratory', $laboratory);
    }

    public function setImagePath(?string $imagePath): void
    {
        $this->setAttribute('image_path', $imagePath);
    }

    public function setPrice(int $price): void
    {
        $this->setAttribute('price', $price);
    }

    public function setStock(int $stock): void
    {
        $this->setAttribute('stock', $stock);
    }

    public function setFlavour(string $flavour): void
    {
        $this->setAttribute('flavour', $flavour);
    }

    public function setExpirationDate(string $expirationDate): void
    {
        $this->setAttribute('expiration_date', $expirationDate);
    }

    public function setIngredients(string $ingredients): void
    {
        $this->setAttribute('ingredients', $ingredients);
    }

    // Eloquent relationships
    public function items(): HasMany
    {
        return $this->hasMany(Item::class);
    }

    public function getItems(): Collection
    {
        return $this->items;
    }

    public function reviews(): HasMany
    {
        return $this->hasMany(Review::class);
    }

    public function getReviews(): Collection
    {
        return $this->reviews;
    }

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class, 'category_supplement')->withTimestamps();
    }

    public function getCategories(): Collection
    {
        return $this->categories;
    }

    public function tests(): BelongsToMany
    {
        return $this->belongsToMany(Test::class, 'supplement_test')->withTimestamps();
    }

    public function getTests(): Collection
    {
        return $this->tests;
    }

    // Utility methods
    public function scopeSearch(Builder $query, string $search): Builder
    {
        return $query->where(function ($query) use ($search) {
            $query->where('name', 'LIKE', "%$search%")
                ->orWhere('description', 'LIKE', "%$search%")
                ->orWhere('laboratory', 'LIKE', "%$search%")
                ->orWhere('flavour', 'LIKE', "%$search%");
        });
    }

    public function scopeFilter(Builder $query, ?int $categoryId = null, ?int $minPrice = null, ?int $maxPrice = null, ?int $inStock = null): Builder
    {
        if ($categoryId) {
            $query->whereHas('categories', function ($q) use ($categoryId) {
                $q->where('categories.id', $categoryId);
            });
        }

        if ($minPrice) {
            $query->where('price', '>=', $minPrice);
        }

        if ($maxPrice) {
            $query->where('price', '<=', $maxPrice);
        }

        if ($inStock === 1) {
            $query->where('stock', '>', 0);
        }

        return $query;
    }

    public function scopeSortBy(Builder $query, string $field): Builder
    {
        if ($field === 'rating') {
            return $query->withAvg('reviews', 'rating')->orderBy('reviews_avg_rating', 'desc');
        }

        return $query->orderBy($field, 'asc');
    }

    public function getAverageRating(): float
    {
        $reviews = $this->getReviews();
        if ($reviews->isEmpty()) {
            return 0.0;
        }

        $total = $reviews->sum('rating');

        return round($total / $reviews->count(), 2);
    }
}
