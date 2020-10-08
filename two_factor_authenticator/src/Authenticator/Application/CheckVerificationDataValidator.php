<?php

declare(strict_types=1);

namespace App\Authenticator\Application;

use App\Authenticator\Domain\Code;
use DateInterval;
use DateTimeImmutable;

final class CheckVerificationDataValidator implements DataValidator
{
    public function validate(array $data): void {
        $key = 'code';
        if (!array_key_exists($key, $data)) {
            throw InvalidDataException::create($key);
        }
    }
}
