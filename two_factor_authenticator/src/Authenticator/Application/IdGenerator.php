<?php

namespace App\Authenticator\Application;

use App\Authenticator\Domain\Id;

interface IdGenerator
{
    public function generate(): Id;
}
