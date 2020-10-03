<?php

declare(strict_types=1);

namespace Authenticator\Application;

use Exception;

final class CodeException extends Exception
{
    public static function fromLength(string $code, int $length): self {
        return new static("The code $code has an invalid length: $length");
    }

    public static function fromExpiration(string $code): self {
        return new static("The code $code was expired");
    }
}
