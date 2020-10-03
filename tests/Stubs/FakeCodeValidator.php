<?php

declare(strict_types=1);

namespace Tests\Stubs;

use Authenticator\Application\CodeValidator;
use Authenticator\Domain\Code;

final class FakeCodeValidator implements CodeValidator {

    public function validate(Code $code): void
    {
        //noop
    }
}
