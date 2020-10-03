<?php

declare(strict_types=1);

namespace Authenticator\Application;

use Exception;

final class ExpiredCodeException extends Exception
{
    public static function create(string $code): self {
        return new static("The code $code has expired");
    }
}
