<?php

declare(strict_types=1);

namespace Tests\Stubs;

use App\Authenticator\Domain\Verification;

final class FakeVerification extends Verification {

    public function __construct()
    {
        //noop
    }
}
