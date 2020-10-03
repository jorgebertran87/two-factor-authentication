<?php

declare(strict_types = 1);

namespace Tests;

use PHPUnit\Framework\TestCase;
use Authenticator\Domain\Code;
use Authenticator\Infrastructure\RandomAlphanumericCodeGenerator;

class codeTest extends TestCase
{
    /** @test */
    public function itShouldReturnAValidRandomAlphanumericCode() {
        $codeGenerator = new RandomAlphanumericCodeGenerator();
        $code = new Code($codeGenerator);
        $this->assertEquals(RandomAlphanumericCodeGenerator::LENGTH, strlen((string)$code));
    }
}
