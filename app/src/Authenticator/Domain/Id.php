<?php

declare(strict_types=1);

namespace App\Authenticator\Domain;

final class Id
{
    private string $id;

    public function __construct(string $id)
    {
        $this->id = $id;
    }

    public function __toString()
    {
        return $this->id;
    }
}
