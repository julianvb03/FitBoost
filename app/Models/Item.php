<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Item extends Model
{
    /**
     * ITEM ATTRIBUTES
     * $this->attributes['id'] - int - contains the int primary key (id)
     * $this->attributes['quantity'] - int - contains the item quantity
     * $this->attributes['totalPrice'] - int - contains the total price for the item (price (from Product) * quantity)
     * $this->attributes['created_at'] - timestamp - contains the item creation date
     * $this->attributes['updated_at'] - timestamp - contains the item update date
     * $this->attributes['supplement_id'] - int - contains the referenced supplement
     * $this->order - Order - contains the associated Order
     * $this->supplement - Supplement - contains the associated Supplement
     */
    public function getId(): int
    {
        return $this->attributes['id'];
    }

    public function getQuantity(): int
    {
        return $this->attributes['quantity'];
    }

    // Other model necesary for total price calculation
    // public function getTotalPrice(): int
    // {
    //     return $this->attributes['quantity'] * $this->supplement->getPrice();
    // }

    public function getOrderId(): int
    {
        return $this->attributes['order_id'];
    }

    public function getProductId(): int
    {
        return $this->attributes['product_id'];
    }

    public function getCreatedAt(): string
    {
        return $this->attributes['created_at'];
    }

    public function getUpdatedAt(): string
    {
        return $this->attributes['updated_at'];
    }

    public function setQuantity(int $quantity): void
    {
        $this->attributes['quantity'] = $quantity;
    }

    public function setOrderId(int $orderId): void
    {
        $this->attributes['order_id'] = $orderId;
    }

    public function setProductId(int $productId): void
    {
        $this->attributes['product_id'] = $productId;
    }

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }

    public function supplement(): BelongsTo
    {
        return $this->belongsTo(Supplement::class);
    }
}
