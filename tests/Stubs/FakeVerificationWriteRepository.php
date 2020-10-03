<?php

declare(strict_types=1);

namespace Tests\Stubs;

use Authenticator\Application\VerificationWriteRepository;
use Authenticator\Domain\Verification;

final class FakeVerificationWriteRepository implements VerificationWriteRepository {

    public function save(Verification $verification): void
    {
        //noop
    }
}
