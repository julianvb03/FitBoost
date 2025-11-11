<?php

namespace App\DTO;

class BmiCalculationInput
{
    public function __construct(
        private readonly float $weight,
        private readonly float $height,
        private readonly string $system
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            (float) $data['weight'],
            (float) $data['height'],
            $data['system'] === 'imperial' ? 'imperial' : 'metric'
        );
    }

    public function weight(): float
    {
        return $this->weight;
    }

    public function height(): float
    {
        return $this->height;
    }

    public function system(): string
    {
        return $this->system;
    }

    public function isMetric(): bool
    {
        return $this->system === 'metric';
    }

    public function isImperial(): bool
    {
        return $this->system === 'imperial';
    }
}
