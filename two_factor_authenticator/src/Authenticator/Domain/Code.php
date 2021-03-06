<?php

declare(strict_types=1);

namespace App\Authenticator\Domain;

use DateTimeImmutable;

final class Code
{
    private string $value;
    private DateTimeImmutable $generatedAt;

    public function __construct(string $value, DateTimeImmutable $generatedAt)
    {
        if (!$this->isAlphanumeric($value)) {
            throw  InvalidAlphanumericFormatException::create($value);
        }

        $this->value = $value;
        $this->generatedAt = $generatedAt;
    }

    private function isAlphanumeric(string $value): bool
    {
        return ctype_alnum($value);
    }

    public function value(): string
    {
        return $this->value;
    }

    public function generatedAt(): DateTimeImmutable
    {
        return $this->generatedAt;
    }

    public function isMaster(): bool
    {
        return $this->value === $_ENV['MASTER_CODE'];
    }
}
