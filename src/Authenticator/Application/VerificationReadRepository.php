<?php

namespace Authenticator\Application;

use Authenticator\Domain\Verification;

interface VerificationReadRepository
{
    public function findByIdAndCode(string $id, string $code): ?Verification;
    public function findById(string $id): ?Verification;
}
