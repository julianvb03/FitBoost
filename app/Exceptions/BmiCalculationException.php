<?php

namespace App\Exceptions;

use RuntimeException;
use Throwable;

class BmiCalculationException extends RuntimeException
{
    public function __construct(
        private readonly string $userMessage,
        private readonly string $level = 'warning', ? Throwable $previous = null
    ) {
        parent::__construct($userMessage, 0, $previous);
    }

    public function userMessage(): string
    {
        return $this->userMessage;
    }

    public function level(): string
    {
        return $this->level;
    }
}
