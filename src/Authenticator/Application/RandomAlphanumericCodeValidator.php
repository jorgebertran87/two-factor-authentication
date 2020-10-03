<?php

declare(strict_types=1);

namespace Authenticator\Application;

use Authenticator\Domain\Code;
use DateInterval;
use DateTimeImmutable;

final class RandomAlphanumericCodeValidator implements CodeValidator
{
    public const EXPIRES_IN_SECONDS = 300;

    private const LENGTH = 4;

    public function validate(Code $code): void {
        $codeLength = strlen($code->value());
        if ($codeLength !== self::LENGTH) {
            throw InvalidCodeLengthException::create($code->value(), $codeLength);
        }

        $now = new DateTimeImmutable();
        $limitDateTime = $this->substractSeconds($now, SELF::EXPIRES_IN_SECONDS);

        if ($code->generatedAt() < $limitDateTime ) {
            throw ExpiredCodeException::create($code->value());
        }

        $this->code = $code;
    }

    private function substractSeconds(DateTimeImmutable $dateTime, int $seconds): DateTimeImmutable
    {
        $limitInterval = new DateInterval('PT' . (string)$seconds . 'S');
        return $dateTime->sub($limitInterval);
    }
}
