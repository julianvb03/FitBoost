<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Support\Carbon;

class User extends Authenticatable
{
    use HasFactory, HasRoles, Notifiable;

    /**
     * USER ATTRIBUTES
     * $this->attributes['id']          - int       - contains the user primary key (id)
     * $this->attributes['name']        - string    - contains the user name
     * $this->attributes['email']       - string    - contains the user email
     * $this->attributes['password']    - string    - contains the user password hashed
     * $this->attributes['address']     - string    - contains the user address
     * $this->attributes['cardData']    - string    - contains the user card data to process payments
     * $this->attributes['created_at']  - timestamp - contains the user creation date
     * $this->attributes['updated_at']  - timestamp - contains the user update date
     * $this->orders                    - Order[]   - contains the user's orders
     * $this->reviews                   - Review[]  - contains the user's reviews
     * $this->tests                     - Test[]    - contains the user's tests
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'address',
        // 'cardData',
    ];

    protected $hidden = [
        'password',
        'remember_token',
        'cardData',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'cardData' => 'encrypted',
        ];
    }

    // Getters

    public function getId(): int
    {
        return $this->attributes['id'];
    }

    public function getName(): string
    {
        return $this->attributes['name'];
    }

    public function getEmail(): string
    {
        return $this->attributes['email'];
    }

    public function getAddress(): ?string
    {
        return $this->attributes['address'] ?? null;
    }

    public function getCardData(): ?string
    {
        return $this->attributes['cardData'] ?? null;
    }

    public function getCreatedAt(): Carbon
    {
        return $this->attributes['created_at'];
    }

    public function getUpdatedAt(): Carbon
    {
        return $this->attributes['updated_at'];
    }

    // Setters

    public function setName(string $name): void
    {
        $this->attributes['name'] = $name;
    }

    public function setEmail(string $email): void
    {
        $this->attributes['email'] = $email;
    }

    public function setAddress(string $address): void
    {
        $this->attributes['address'] = $address;
    }

    public function setCardData(string $cardData): void
    {
        $this->attributes['cardData'] = $cardData;
    }

    // Eloquent Relationships
    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }

    public function getOrders(): Collection
    {
        return $this->orders;
    }

    public function reviews(): HasMany
    {
        return $this->hasMany(Review::class);
    }

    public function getReviews(): Collection
    {
        return $this->reviews;
    }

    public function tests(): HasMany
    {
        return $this->hasMany(Test::class);
    }

    public function getTests(): Collection
    {
        return $this->tests;
    }
}
