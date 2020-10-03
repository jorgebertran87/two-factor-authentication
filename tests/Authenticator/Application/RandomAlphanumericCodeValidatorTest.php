<?php

declare(strict_types = 1);

namespace Tests\Authenticator\Application;

use Authenticator\Application\ExpiredCodeException;
use Authenticator\Application\InvalidCodeLengthException;
use Authenticator\Application\RandomAlphanumericCodeValidator;
use Authenticator\Domain\Code;
use DateInterval;
use DateTimeImmutable;
use PHPUnit\Framework\TestCase;

class RandomAlphanumericCodeValidatorTest extends TestCase
{
    /** @test */
    public function itShouldThrowInvalidCodeLengthException() {
        $code = new Code('AS24G6', new DateTimeImmutable());
        $codeValidator = new RandomAlphanumericCodeValidator();

        $this->expectException(InvalidCodeLengthException::class);
        $codeValidator->validate($code);
    }

    /** @test */
    public function itShouldThrowExpiredCodeException() {
        $now = new DateTimeImmutable();
        $expiredDateTime = $this->substractSeconds($now, RandomAlphanumericCodeValidator::EXPIRES_IN_SECONDS + 1);

        $code = new Code('AS24', $expiredDateTime);
        $codeValidator = new RandomAlphanumericCodeValidator();

        $this->expectException(ExpiredCodeException::class);
        $codeValidator->validate($code);
    }

    private function substractSeconds(DateTimeImmutable $dateTime, int $seconds): DateTimeImmutable
    {
        $limitInterval = new DateInterval('PT' . (string)$seconds . 'S');
        return $dateTime->sub($limitInterval);
    }
}
