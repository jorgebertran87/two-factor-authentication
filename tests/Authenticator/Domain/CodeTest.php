<?php

declare(strict_types = 1);

namespace Tests\Authenticator\Domain;

use PHPUnit\Framework\TestCase;
use Authenticator\Domain\Code;
use Tests\Doubles\FakeCodeGenerator;

class CodeTest extends TestCase
{
    /** @test */
    public function itShouldReturnAValidCode() {
        $codeGenerator = new FakeCodeGenerator();
        $code = new Code($codeGenerator);
        $this->assertEquals(FakeCodeGenerator::CODE, $code);
    }
}
