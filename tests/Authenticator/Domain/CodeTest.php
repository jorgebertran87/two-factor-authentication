<?php

declare(strict_types = 1);

namespace Tests\Authenticator\Domain;

use Authenticator\Domain\Code;
use Authenticator\Domain\InvalidAlphanumericFormatException;
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
