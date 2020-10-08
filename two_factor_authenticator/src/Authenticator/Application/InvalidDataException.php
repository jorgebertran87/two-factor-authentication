<?php

declare(strict_types=1);

namespace App\Authenticator\Application;

use Exception;

final class InvalidDataException extends Exception
{
    public static function create(string $missingKey): self {
        return new static("The data sent is invalid: $missingKey is required");
    }
}
