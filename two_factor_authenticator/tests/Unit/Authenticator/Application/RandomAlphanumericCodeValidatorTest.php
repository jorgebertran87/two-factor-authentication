<?php

declare(strict_types = 1);

namespace Tests\Unit\Authenticator\Application;

use App\Authenticator\Application\ExpiredCodeException;
use App\Authenticator\Application\InvalidCodeLengthException;
use App\Authenticator\Application\RandomAlphanumericCodeValidator;
use App\Authenticator\Domain\Code;
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
