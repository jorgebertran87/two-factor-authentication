<?php

declare(strict_types=1);

namespace App\Authenticator\Application;


final class RetrieveVerificationDataValidator implements DataValidator
{
    public function validate(array $data): void
    {
        $key = 'phoneNumber';
        if (!array_key_exists($key, $data)) {
            throw InvalidDataException::create($key);
        }
    }
}
