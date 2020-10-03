<?php

declare(strict_types=1);

namespace Tests\Stubs;

use App\Authenticator\Application\VerificationWriteRepository;
use App\Authenticator\Domain\Verification;

final class FakeVerificationWriteRepository implements VerificationWriteRepository {

    public function save(Verification $verification): void
    {
        //noop
    }
}
