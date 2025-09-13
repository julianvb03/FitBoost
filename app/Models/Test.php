<?php

declare(strict_types=1);

namespace App\Models;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * TEST ATTRIBUTES
 * $this->attributes['id']            - int      - primary key (id)
 * $this->attributes['user_id']       - int      - user owner of the test
 * $this->attributes['context']       - string   - general context (e.g., Fitness)
 * $this->attributes['routine']       - string   - training routine
 * $this->attributes['diet']          - string   - diet description
 * $this->attributes['weight']        - int      - weight in kg (unsigned)
 * $this->attributes['height']        - int      - height in cm (unsigned)
 * $this->attributes['goals']         - string[] - goals list (stored as JSON text)
 * $this->attributes['responses']     - string[] - questionnaire responses (stored as JSON text)
 * $this->attributes['creation_date'] - date     - date when the test was taken
 * $this->attributes['status']        - string   - status (pending/completed)
 */
final class Test extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
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

    public function getCreationDate(): Carbon
    {
        return $this->getAttribute('creation_date');
    }

    public function getStatus(): string
    {
        return $this->getAttribute('status');
    }

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

    public function setCreationDate(DateTimeInterface $creationDate): void
    {
        $this->setAttribute('creation_date', $creationDate);
    }

    public function setStatus(string $status): void
    {
        $this->setAttribute('status', $status);
    }

    // Planned relationships (commented out until target models/migrations exist)
    // public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo {}
    // public function supplements(): \Illuminate\Database\Eloquent\Relations\BelongsToMany {}
}
