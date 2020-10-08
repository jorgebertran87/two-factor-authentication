<?php

declare(strict_types=1);

namespace App\Authenticator\Application;

final class RetrieveVerificationQuery
{
    private string $phoneNumber;

    public function __construct(string $phoneNumber)
    {
        $this->phoneNumber = $phoneNumber;
    }

    public function phoneNumber(): string
    {
        return $this->phoneNumber;
    }
}
