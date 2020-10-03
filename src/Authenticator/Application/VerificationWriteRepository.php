<?php

namespace Authenticator\Application;

use Authenticator\Domain\Verification;

interface VerificationWriteRepository
{
    public function save(Verification $verification): void;
}
