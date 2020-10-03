<?php

declare(strict_types=1);

namespace Authenticator\Domain;

final class User
{
    private Code $code;
    private Phone $phone;

    public function __construct(Code $code, Phone $phone)
    {
        $this->code = $code;
        $this->phone = $phone;
    }

    public function code(): Code
    {
        return $this->code;
    }

    public function phone(): Phone
    {
        return $this->phone;
    }
}
