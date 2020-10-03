<?php

declare(strict_types = 1);

namespace Tests\Authenticator\Infrastructure;

use PHPUnit\Framework\TestCase;
use Authenticator\Infrastructure\RandomAlphanumericCodeGenerator;

class RandomAlphanumericCodeGeneratorTest extends TestCase
{
    /** @test */
    public function itShouldGenerateAValidRandomAlphanumericCode() {
        $codeGenerator = new RandomAlphanumericCodeGenerator();
        $code = $codeGenerator->generate();
        $this->assertEquals(RandomAlphanumericCodeGenerator::LENGTH, strlen($code));
    }
}
