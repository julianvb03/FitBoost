<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\Relations\HasMany;

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
        #'cardData',
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

    getId(): int
    {
        return $this->attributes['id'];
    }

    // public function orders(): HasMany
    // {
    //     return $this->hasMany(Order::class);
    // }

    // public function reviews(): HasMany
    // {
    //     return $this->hasMany(Review::class);
    // }

    // public function tests(): HasMany
    // {
    //     return $this->hasMany(Test::class);
    // }
}
