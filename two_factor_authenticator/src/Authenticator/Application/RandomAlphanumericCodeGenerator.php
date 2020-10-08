<?php

declare(strict_types=1);

namespace App\Authenticator\Application;

use App\Authenticator\Domain\Code;
use DateTimeImmutable;

final class RandomAlphanumericCodeGenerator implements CodeGenerator
{
    public const LENGTH = 4;

    private const PERMITTED_CHARS = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';

    public function generate(): Code
    {
        $code = substr(str_shuffle(self::PERMITTED_CHARS), 0, self::LENGTH);
        $now = new DateTimeImmutable();

        return new Code($code, $now);
    }
}
