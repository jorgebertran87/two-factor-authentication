<?php

declare(strict_types=1);

namespace Authenticator\Domain;

class Verification
{
    private Id $id;
    private Code $code;
    private Phone $phone;

    public function __construct(Id $id, Code $code, Phone $phone)
    {
        $this->id = $id;
        $this->code = $code;
        $this->phone = $phone;
    }

    public function id(): Id
    {
        return $this->id;
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
