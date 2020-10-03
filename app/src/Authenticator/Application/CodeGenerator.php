<?php

namespace App\Authenticator\Application;

use App\Authenticator\Domain\Code;

interface CodeGenerator
{
    public function generate(): Code;
}
