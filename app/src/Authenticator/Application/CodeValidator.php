<?php

namespace App\Authenticator\Application;

use App\Authenticator\Domain\Code;

interface CodeValidator
{
    public function validate(Code $code): void;
}
