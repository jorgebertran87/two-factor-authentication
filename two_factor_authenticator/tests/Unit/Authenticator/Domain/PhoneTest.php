<?php

declare(strict_types = 1);

namespace Tests\Authenticator\Domain;

use App\Authenticator\Domain\InvalidSpanishMobilePhoneNumberException;
use App\Authenticator\Domain\Phone;
use PHPUnit\Framework\TestCase;

class PhoneTest extends TestCase
{
    /** @test */
    public function itShouldReturnAValidPhone()
    {
        $validPhone = new Phone('611 11 11 11');
        $this->assertEquals('611111111', $validPhone->number());
    }
    /** @test */
    public function itShouldThrowAnInvalidSpanishPhoneNumberException()
    {
        $this->expectException(InvalidSpanishMobilePhoneNumberException::class);
        $invalidPhone = new Phone('111 11 11 11 1');
    }
}
