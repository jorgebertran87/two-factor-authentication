<?php

declare(strict_types=1);

namespace Authenticator\Infrastructure;

use Authenticator\Domain\CodeGenerator;

final class RandomAlphanumericCodeGenerator implements CodeGenerator
{
    public const LENGTH = 4;

    private const PERMITTED_CHARS = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';

    public function generate(): string {
        return substr(str_shuffle(self::PERMITTED_CHARS), 0, self::LENGTH);
    }
}
