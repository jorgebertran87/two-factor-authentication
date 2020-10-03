<?php

declare(strict_types=1);

namespace App\Authenticator\Domain;

final class Phone
{
    private SpanishMobilePhoneNumber $phoneNumber;

    public function __construct(string $number)
    {
        $this->phoneNumber = new SpanishMobilePhoneNumber($number);
    }

    public function number(): string
    {
        return $this->phoneNumber->number();
    }
}
