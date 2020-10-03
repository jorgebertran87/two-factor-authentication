<?php

declare(strict_types=1);

namespace Authenticator\Domain;

final class Code {
    public const LENGTH = 4;

    public function __construct()
    {
        $this->value = "4FDA";
    }

    public function __toString(): string
    {
        return $this->value;
    }
}
