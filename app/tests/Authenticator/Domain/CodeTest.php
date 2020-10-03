<?php

declare(strict_types = 1);

namespace Tests\Authenticator\Domain;

use App\Authenticator\Domain\Code;
use App\Authenticator\Domain\InvalidAlphanumericFormatException;
use DateTimeImmutable;
use PHPUnit\Framework\TestCase;

class CodeTest extends TestCase
{
    /** @test */
    public function itShouldGenerateAValidRandomAlphanumericCode() {
        $this->expectException(InvalidAlphanumericFormatException::class);
        $invalidCode = new Code('_asds1', new DateTimeImmutable());
    }
}
