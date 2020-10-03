<?php

declare(strict_types=1);

namespace Tests\Stubs;

use App\Authenticator\Application\CodeValidator;
use App\Authenticator\Domain\Code;

final class FakeCodeValidator implements CodeValidator {

    public function validate(Code $code): void
    {
        //noop
    }
}
