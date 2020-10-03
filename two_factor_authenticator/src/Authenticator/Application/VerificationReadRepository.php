<?php

namespace App\Authenticator\Application;

use App\Authenticator\Domain\Verification;

interface VerificationReadRepository
{
    public function findByIdAndCode(string $id, string $code): ?Verification;
    public function findById(string $id): ?Verification;
}
