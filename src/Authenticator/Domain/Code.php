<?php

declare(strict_types=1);

namespace Authenticator\Domain;

use DateTimeImmutable;

final class Code
{
    private string $value;
    private DateTimeImmutable $generatedAt;

    public function __construct(string $value, DateTimeImmutable $generatedAt)
    {
        $this->value = $value;
        $this->generatedAt = $generatedAt;
    }

    public function value(): string
    {
        return $this->value;
    }

    public function generatedAt(): DateTimeImmutable
    {
        return $this->generatedAt;
    }
}
