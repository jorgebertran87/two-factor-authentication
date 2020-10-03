<?php

namespace Authenticator\Application;

use Authenticator\Domain\Id;

interface IdGenerator
{
    public function generate(): Id;
}
