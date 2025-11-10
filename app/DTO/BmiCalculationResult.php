<?php

namespace App\DTO;

class BmiCalculationResult
{
    public function __construct(
        private readonly float $bmi,
        private readonly string $category,
        private readonly string $healthyRange,
        private string $source,
        private bool $fallback = false,
        private ?string $message = null,
        private string $messageLevel = 'info'
    ) {}

    public function bmi(): float
    {
        return $this->bmi;
    }

    public function category(): string
    {
        return $this->category;
    }

    public function healthyRange(): string
    {
        return $this->healthyRange;
    }

    public function source(): string
    {
        return $this->source;
    }

    public function isFallback(): bool
    {
        return $this->fallback;
    }

    public function message(): ?string
    {
        return $this->message;
    }

    public function messageLevel(): string
    {
        return $this->messageLevel;
    }

    public function markFallback(string $source = 'local'): void
    {
        $this->fallback = true;
        $this->source = $source;
    }

    public function setMessage(?string $message, string $level = 'info'): void
    {
        $this->message = $message;
        $this->messageLevel = $level;
    }

    public function toArray(): array
    {
        return [
            'bmi' => round($this->bmi, 1),
            'category' => $this->category,
            'healthy_range' => $this->healthyRange,
            'source' => $this->source,
            'fallback' => $this->fallback,
            'message' => $this->message,
            'message_level' => $this->messageLevel,
        ];
    }
}
