<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Order extends Model
{
    /**
     * ITEM ATTRIBUTES
     * $this->attributes['id'] - int - contains the int primary key (id)
     * $this->attributes['status'] - string - contains the order status (eg. pending, completed, cancelled)
     * $this->attributes['user_id'] - int - contains the id of the user who made the order
     * $this->attributes['totalAmount'] - int - contains the total price for the order with the add of the items
     * $this->attributes['created_at'] - timestamp - contains the item creation date
     * $this->attributes['updated_at'] - timestamp - contains the item update date
     * $this->user - User - contains the associated User
     * $this->items - Item[] - contains the associated Items
     */

    public function getId(): int
    {
        return $this->attributes['id'];
    }

    public function getStatus(): string
    {
        return $this->attributes['status'];
    }

    public function getUserId(): int
    {
        return $this->attributes['user_id'];
    }

    public function getTotalAmount(): int
    {
        return $this->attributes['totalAmount'];
    }

    public function getCreatedAt(): string
    {
        return $this->attributes['created_at'];
    }

    public function getUpdatedAt(): string
    {
        return $this->attributes['updated_at'];
    }

    public function setStatus(string $status): void
    {
        $this->attributes['status'] = $status;
    }

    // Relationship necesary for Eloquent
    // public function setTotalAmount(int $totalAmount): void
    // {
    // 
    // }

    // public function user(): BelongsTo
    // {
    //     return $this->belongsTo(User::class);
    // }

    // public function setUser(User $user): void
    // {
    //     $this->user()->associate($user);
    // }

    // public function getUser(): User
    // {
    //     return $this->user;
    // }

    // public function items()
    // {
    //     return $this->hasMany(Item::class);
    // }

    // public function setItems(Collection $items): void
    // {
    //     $this->items()->sync($items);
    // }

    // public function getItems(): Collection
    // {
    //     return $this->items;
    // }

}