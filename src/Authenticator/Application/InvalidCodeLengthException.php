<?php

declare(strict_types=1);

namespace Authenticator\Application;

use Exception;

final class InvalidCodeLengthException extends Exception
{
    public static function create(string $code, int $length): self {
        return new static("The code $code has an invalid length: $length");
    }
}
