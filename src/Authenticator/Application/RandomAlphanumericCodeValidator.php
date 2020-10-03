<?php

declare(strict_types=1);

namespace Authenticator\Application;

use Authenticator\Domain\Code;
use DateInterval;
use DateTimeImmutable;

final class RandomAlphanumericCodeValidator implements CodeValidator
{
    private const EXPIRES_IN_SECONDS = 300;

    private const LENGTH = 4;

    public function validate(Code $code): void {
        $codeLength = strlen($code->value());
        if ($codeLength !== self::LENGTH) {
            throw CodeException::fromLength($code->value(), $codeLength);
        }

        $now = new DateTimeImmutable();
        $limitInterval = new DateInterval((string)SELF::EXPIRES_IN_SECONDS . 's');
        $limitDateTime = $now->sub($limitInterval);
        if ($code->generatedAt() < $limitDateTime ) {
            throw CodeException::fromExpiration($code->value());
        }

        $this->code = $code;
    }
}
