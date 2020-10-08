<?php

declare(strict_types=1);

namespace App\Authenticator\Application;

use Exception;

final class CodeNotFoundException extends Exception
{
    public static function create(string $code): self
    {
        return new static("The code $code doesn't exist");
    }
}
