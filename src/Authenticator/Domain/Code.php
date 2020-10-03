<?php

declare(strict_types=1);

namespace Authenticator\Domain;

final class Code
{
    public function __construct(string $value)
    {
        $this->value = $value;
    }

    public function __toString(): string
    {
        return $this->value;
    }
}
