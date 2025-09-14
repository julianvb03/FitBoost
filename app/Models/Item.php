<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;

class Item extends Model
{
    /**
     * ITEM ATTRIBUTES
     * $this->attributes['id']              - int           - contains the int primary key (id)
     * $this->attributes['quantity']        - int           - contains the item quantity
     * $this->attributes['totalPrice']      - int           - contains the total price for the item
     * $this->attributes['supplement_id']   - int           - contains the referenced supplement
     * $this->attributes['created_at']      - timestamp     - contains the item creation date
     * $this->attributes['updated_at']      - timestamp     - contains the item update date
     * $this->order                         - Order         - contains the associated Order
     * $this->supplement                    - Supplement    - contains the associated Supplement
     */

    /**
     * CALCULATED VALUES
     * totalPrice                           - int           - total price for the item (price * quantity)
     */
    protected $fillable = [
        'quantity',
    ];

    protected $hidden = [
        'updated_at',
        'created_at',
    ];

    // Getters

    public function getId(): int
    {
        return $this->attributes['id'];
    }

    public function getTotalPrice(): int
    {
        return $this->calculateTotalPrice();
    }

    public function getQuantity(): int
    {
        return $this->attributes['quantity'];
    }

    public function getSupplementId(): int
    {
        return $this->attributes['supplement_id'];
    }

    public function getProductId(): int
    {
        return $this->attributes['product_id'];
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

    public function setQuantity(int $quantity): void
    {
        $this->attributes['quantity'] = $quantity;
    }

    public function setTotalPrice(int $totalPrice): void
    {
        $this->attributes['totalPrice'] = $totalPrice;
    }

    public function setOrderId(int $orderId): void
    {
        $this->attributes['order_id'] = $orderId;
    }

    public function setProductId(int $productId): void
    {
        $this->attributes['product_id'] = $productId;
    }

    // Eloquent Relationships

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }

    public function getOrder(): Order
    {
        return $this->order;
    }

    public function supplement(): BelongsTo
    {
        return $this->belongsTo(Supplement::class);
    }

    public function getSupplement(): Supplement
    {
        return $this->supplement;
    }

    // Utility Methods
    public function calculateTotalPrice(): int
    {
        return $this->getSupplement()->getPrice() * $this->getQuantity();
    }
}
