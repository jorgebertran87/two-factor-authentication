<?php

declare(strict_types = 1);

namespace Tests\Authenticator\Domain;

use Authenticator\Domain\Code;
use Authenticator\Domain\InvalidAlphanumericFormatException;
use Authenticator\Domain\InvalidSpanishMobilePhoneNumberException;
use Authenticator\Domain\Phone;
use DateTimeImmutable;
use PHPUnit\Framework\TestCase;

class PhoneTest extends TestCase
{
    /** @test */
    public function itShouldReturnAValidPhone() {
        $validPhone = new Phone('611 11 11 11');
        $this->assertEquals('+34611111111', $validPhone->number());

    }
    /** @test */
    public function itShouldThrowAnInvalidSpanishPhoneNumberException() {
        $this->expectException(InvalidSpanishMobilePhoneNumberException::class);
        $invalidPhone = new Phone('111 11 11 11 1');
    }
}
