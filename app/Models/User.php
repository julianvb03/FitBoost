<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Collection;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasFactory, HasRoles, Notifiable;

    /**
     * USER ATTRIBUTES
     * $this->attributes['id'] - int - contains the user primary key (id)
     * $this->attributes['name'] - string - contains the user name
     * $this->attributes['email'] - string - contains the user email
     * $this->attributes['password'] - string - contains the user password hashed
     * $this->attributes['address'] - string - contains the user address
     * $this->attributes['cardData'] - string - contains the user card data to process payments
     * $this->orders - Order[] - contains the user's orders
     * $this->reviews - Review[] - contains the user's reviews
     * $this->tests - Test[] - contains the user's tests
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
    /*
    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }

    public function setOrders(Collection $orders): void
    {
        $this->orders = $orders;
    }

    public function getOrders(): Collection
    {
        return $this->orders;
    }

    public function reviews(): HasMany
    {
        return $this->hasMany(Review::class);
    }

    public function setReviews(Collection $reviews): void
    {
        $this->reviews = $reviews;
    }

    public function getReviews(): Collection
    {
        return $this->reviews;
    }

    public function tests(): HasMany
    {
        return $this->hasMany(Test::class);
    }

    public function setTests(Collection $tests): void
    {
        $this->tests = $tests;
    }

    public function getTests(): Collection
    {
        return $this->tests;
    }
    */
}
