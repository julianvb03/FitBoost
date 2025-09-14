<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Carbon;

/**
 * SUPPLEMENT ATTRIBUTES
 * $this->attributes['id']               - int      - primary key (id)
 * $this->attributes['name']             - string   - supplement name
 * $this->attributes['description']      - string   - detailed description
 * $this->attributes['laboratory']       - string   - manufacturer or laboratory name
 * $this->attributes['images']           - string[] - list of image URLs
 * $this->attributes['price']            - int      - price (unsigned integer)
 * $this->attributes['stock']            - int      - available quantity (unsigned integer)
 * $this->attributes['flavour']          - string   - flavour of the supplement
 * $this->attributes['expiration_date']  - date     - expiration date
 * $this->attributes['ingredients']      - string[] - list of ingredients
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
        'images',
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
            'images' => 'array',
            'ingredients' => 'array',
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

    public function getImages(): array
    {
        return $this->getAttribute('images') ?? [];
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

    public function getIngredients(): array
    {
        return $this->getAttribute('ingredients') ?? [];
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

    public function setImages(array $images): void
    {
        $this->setAttribute('images', $images);
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

    public function setExpirationDate(\DateTimeInterface $expirationDate): void
    {
        $this->setAttribute('expiration_date', $expirationDate);
    }

    public function setIngredients(array $ingredients): void
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
}
