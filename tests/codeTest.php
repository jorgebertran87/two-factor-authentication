<?php

declare(strict_types = 1);

namespace Tests;

use PHPUnit\Framework\TestCase;
use Authenticator\Domain\Code;

class codeTest extends TestCase
{
    /** @test */
    public function itShouldReturnAValidCode() {
        $code = new Code();
        $this->assertEquals(Code::LENGTH, strlen((string)$code));
    }
}
