<?php

namespace App\Authenticator\Application;

use App\Authenticator\Domain\Verification;

interface VerificationWriteRepository
{
    public function save(Verification $verification): void;
}
