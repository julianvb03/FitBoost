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
        return $this->getAttribute('id');
    }

    public function getStatus(): string
    {
        return $this->getAttribute('status');
    }

    public function getTotalAmount(): int
    {
        return $this->getAttribute('totalAmount');
    }

    public function getUserId(): int
    {
        return $this->getAttribute('user_id');
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

    public function setStatus(string $status): void
    {
        $this->setAttribute('status', $status);
    }

    public function setUserId(int $userId): void
    {
        $this->setAttribute('user_id', $userId);
    }

    public function setTotalAmount(int $totalAmount): void
    {
        $this->setAttribute('totalAmount', $totalAmount);
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
