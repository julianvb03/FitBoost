<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;

class Review extends Model
{
    /**
     * ITEM ATTRIBUTES.
     * $this->attributes['id']              - int        - contains the int primary key (id)
     * $this->attributes['rating']          - int        - contains the review rating
     * $this->attributes['comment']         - string     - contains the review comment
     * $this->attributes['status']          - boolean    - contains the review status
     * $this->attributes['user_id']         - int        - contains the review user id
     * $this->attributes['supplement_id']   - int        - contains the review supplement id
     * $this->attributes['created_at']      - timestamp  - contains the review creation date
     * $this->attributes['updated_at']      - timestamp  - contains the review last update date
     * $this->user                          - User       - contains the associated User
     * $this->supplement                    - Supplement - contains the associated Supplement
     */
    protected $fillable = [
        'rating',
        'comment',
    ];

    // Getters

    public function getId(): int
    {
        return $this->attributes['id'];
    }

    public function getRating(): int
    {
        return $this->attributes['rating'];
    }

    public function getComment(): string
    {
        return $this->attributes['comment'];
    }

    public function getStatus(): bool
    {
        return $this->attributes['status'];
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

    public function setRating(int $rating): void
    {
        $this->attributes['rating'] = $rating;
    }

    public function setComment(string $comment): void
    {
        $this->attributes['comment'] = $comment;
    }

    public function setStatus(bool $status): void
    {
        $this->attributes['status'] = $status;
    }

    // Eloquent Relationships
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function getUser(): User
    {
        return $this->user;
    }

    public function supplement(): BelongsTo
    {
        return $this->belongsTo(Supplement::class);
    }

    public function getSupplement(): Supplement
    {
        return $this->supplement;
    }
}
