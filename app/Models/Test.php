<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

final class Test extends Model
{
    /**
     * TEST ATTRIBUTES
     * $this->attributes['id']            - int             - primary key (id)
     * $this->attributes['user_id']       - int             - user owner of the test
     * $this->attributes['context']       - string          - general context (e.g., Fitness)
     * $this->attributes['routine']       - string          - training routine
     * $this->attributes['diet']          - string          - diet description
     * $this->attributes['weight']        - int             - weight in kg (unsigned)
     * $this->attributes['height']        - int             - height in cm (unsigned)
     * $this->attributes['goals']         - string[]        - goals list
     * $this->attributes['responses']     - string[]        - questionnaire responses
     * $this->attributes['status']        - string          - status (pending/completed)
     * $this->attributes['created_at']    - timestamp       - creation date
     * $this->attributes['updated_at']    - timestamp       - last update date
     * $this->user                        - User            - associated User
     * $this->supplements                 - Supplement[]    - associated Supplements
     */
    protected $fillable = [
        'context',
        'routine',
        'diet',
        'weight',
        'height',
        'goals',
        'responses',
        'creation_date',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'goals' => 'array',
            'responses' => 'array',
            'weight' => 'integer',
            'height' => 'integer',
            'creation_date' => 'date',
        ];
    }

    // Getters
    public function getId(): int
    {
        return $this->getAttribute('id');
    }

    public function getUserId(): int
    {
        return $this->getAttribute('user_id');
    }

    public function getContext(): string
    {
        return $this->getAttribute('context');
    }

    public function getRoutine(): string
    {
        return $this->getAttribute('routine');
    }

    public function getDiet(): string
    {
        return $this->getAttribute('diet');
    }

    public function getWeight(): int
    {
        return $this->getAttribute('weight');
    }

    public function getHeight(): int
    {
        return $this->getAttribute('height');
    }

    public function getGoals(): array
    {
        return $this->getAttribute('goals') ?? [];
    }

    public function getResponses(): array
    {
        return $this->getAttribute('responses') ?? [];
    }

    public function getStatus(): string
    {
        return $this->getAttribute('status');
    }

    // Setters
    public function setUserId(int $userId): void
    {
        $this->setAttribute('user_id', $userId);
    }

    public function setContext(string $context): void
    {
        $this->setAttribute('context', $context);
    }

    public function setRoutine(string $routine): void
    {
        $this->setAttribute('routine', $routine);
    }

    public function setDiet(string $diet): void
    {
        $this->setAttribute('diet', $diet);
    }

    public function setWeight(int $weight): void
    {
        $this->setAttribute('weight', $weight);
    }

    public function setHeight(int $height): void
    {
        $this->setAttribute('height', $height);
    }

    public function setGoals(array $goals): void
    {
        $this->setAttribute('goals', $goals);
    }

    public function setResponses(array $responses): void
    {
        $this->setAttribute('responses', $responses);
    }

    public function setStatus(string $status): void
    {
        $this->setAttribute('status', $status);
    }

    // Eloquent relationships
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function getUser(): User
    {
        return $this->user;
    }

    public function supplements(): BelongsToMany
    {
        return $this->belongsToMany(Supplement::class, 'supplement_test')->withTimestamps();
    }

    public function getSupplements(): Collection
    {
        return $this->supplements;
    }
}
