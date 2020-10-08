<?php

declare(strict_types = 1);

namespace Tests\Unit\Authenticator\Application;

use App\Authenticator\Application\RandomAlphanumericCodeGenerator;
use PHPUnit\Framework\TestCase;

class RandomAlphanumericCodeGeneratorTest extends TestCase
{
    /** @test */
    public function itShouldGenerateAValidRandomAlphanumericCode()
    {
        $codeGenerator = new RandomAlphanumericCodeGenerator();
        $code = $codeGenerator->generate();
        $this->assertEquals(RandomAlphanumericCodeGenerator::LENGTH, strlen($code->value()));
    }
}
