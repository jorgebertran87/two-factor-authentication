<?php

declare(strict_types=1);

namespace Authenticator\Application;

final class RetrieveCodeQuery
{
    private string $phoneNumber;

    public function __construct(string $phoneNumber)
    {
        $this->phoneNumber = $phoneNumber;
    }

    public function phoneNumber(): string {
        return $this->phoneNumber;
    }
}
