<?php

namespace Authenticator\Application;

use Authenticator\Domain\Code;

interface CodeGenerator
{
    public function generate(): Code;
}
