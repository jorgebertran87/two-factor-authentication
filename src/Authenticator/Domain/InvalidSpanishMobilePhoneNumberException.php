<?php

declare(strict_types=1);

namespace Authenticator\Domain;

use Exception;

final class InvalidSpanishMobilePhoneNumberException extends Exception
{
    public static function create(string $number): self {
        return new static("The phone number $number is not a valid spanish mobile");
    }
}
