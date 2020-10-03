<?php

namespace Authenticator\Application;

use Authenticator\Domain\Code;

interface CodeValidator
{
    public function validate(Code $code): void;
}
