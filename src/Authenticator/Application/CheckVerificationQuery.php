<?php

declare(strict_types=1);

namespace Authenticator\Application;

final class CheckVerificationQuery
{
    private string $id;
    private string $code;

    public function __construct(string $id, string $code)
    {
        $this->id = $id;
        $this->code = $code;
    }

    public function id(): string {
        return $this->id;
    }

    public function code(): string {
        return $this->code;
    }
}
