<?php

declare(strict_types=1);

namespace Tests\Doubles;

use Authenticator\Domain\CodeGenerator;

final class FakeCodeGenerator implements CodeGenerator
{
    public const CODE = 'AFD43A';

    public function generate(): string {
        return self::CODE;
    }
}
