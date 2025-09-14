<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Carbon;

class Order extends Model
{
    /**
     * ITEM ATTRIBUTES
     * $this->attributes['id']              - int       - contains the int primary key (id)
     * $this->attributes['status']          - string    - contains the order status (eg. pending, completed, cancelled)
     * $this->attributes['user_id']         - int       - contains the id of the user who made the order
     * $this->attributes['totalAmount']     - int       - contains the total amount for the order
     * $this->attributes['created_at']      - timestamp - contains the item creation date
     * $this->attributes['updated_at']      - timestamp - contains the item update date
     * $this->user                          - User      - contains the associated User
     * $this->items                         - Item[]    - contains the associated Items
     */

    /**
     * CALCULATED VALUES
     * totalAmount                          - int       - total price for the order
     */
    protected $hidden = [
        'created_at',
        'updated_at',
        'user_id',
    ];

    // Getters

    public function getId(): int
    {
        return $this->attributes['id'];
    }

    public function getStatus(): string
    {
        return $this->attributes['status'];
    }

    public function getTotalAmount(): int
    {
        return $this->calculateTotalAmount();
    }

    public function getUserId(): int
    {
        return $this->attributes['user_id'];
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

    public function setStatus(string $status): void
    {
        $this->attributes['status'] = $status;
    }

    public function setUserId(int $userId): void
    {
        $this->attributes['user_id'] = $userId;
    }

    public function setTotalAmount(int $totalAmount): void
    {
        $this->attributes['totalAmount'] = $totalAmount;
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function getUser(): User
    {
        return $this->user;
    }

    public function items(): HasMany
    {
        return $this->hasMany(Item::class);
    }

    public function getItems(): Collection
    {
        return $this->items;
    }

    // Utility Methods

    public function calculateTotalAmount(): int
    {
        return $this->items()->get()->sum(function ($item) {
            return $item->getTotalPrice();
        });
    }
}
