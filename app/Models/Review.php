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
     * $this->attributes['reported']        - boolean    - contains the review reported status
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

    public function getUserId(): int
    {
        return $this->getAttribute('user_id');
    }

    public function getSupplementId(): int
    {
        return $this->getAttribute('supplement_id');
    }

    public function getReported(): bool
    {
        return $this->getAttribute('reported');
    }

    public function getId(): int
    {
        return $this->getAttribute('id');
    }

    public function getRating(): int
    {
        return $this->getAttribute('rating');
    }

    public function getComment(): string
    {
        return $this->getAttribute('comment');
    }

    public function getStatus(): bool
    {
        return $this->getAttribute('status');
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

    public function setUserId(int $userId): void
    {
        $this->setAttribute('user_id', $userId);
    }

    public function setSupplementId(int $supplementId): void
    {
        $this->setAttribute('supplement_id', $supplementId);
    }

    public function setReported(bool $reported): void
    {
        $this->setAttribute('reported', $reported);
    }

    public function setRating(int $rating): void
    {
        $this->setAttribute('rating', $rating);
    }

    public function setComment(string $comment): void
    {
        $this->setAttribute('comment', $comment);
    }

    public function setStatus(bool $status): void
    {
        $this->setAttribute('status', $status);
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

    // Utility methods
    public function getUserName(): string
    {
        return $this->getUser()->getName();
    }

}
