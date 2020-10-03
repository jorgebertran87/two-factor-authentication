<?php

declare(strict_types=1);

namespace Authenticator\Domain;

use Exception;

final class InvalidAlphanumericFormatException extends Exception
{
    public static function create(string $code): self {
        return new static("The code $code is not alphanumeric");
    }
}
