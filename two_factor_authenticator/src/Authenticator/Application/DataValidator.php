<?php

namespace App\Authenticator\Application;

interface DataValidator
{
    public function validate(array $data): void;
}
