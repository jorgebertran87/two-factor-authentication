<?php

declare(strict_types = 1);

namespace Tests\Authenticator\Application;

use Authenticator\Application\RandomAlphanumericCodeGenerator;
use Authenticator\Application\RetrieveCodeQuery;
use Authenticator\Application\RetrieveCodeQueryHandler;
use Authenticator\Application\Uuid5Generator;
use Authenticator\Domain\Verification;
use PHPUnit\Framework\TestCase;
use Tests\Stubs\FakeVerificationWriteRepository;

class RetrieveCodeQueryHandlerTest extends TestCase
{
    /** @test */
    public function itShouldRetrieveAValidVerification() {
        $repository = new FakeVerificationWriteRepository();
        $idGenerator = new Uuid5Generator();
        $codeGenerator = new RandomAlphanumericCodeGenerator();
        $phoneNumber = '611 11 11 11';
        $query = new RetrieveCodeQuery($phoneNumber);
        $queryHandler = new RetrieveCodeQueryHandler($repository, $idGenerator, $codeGenerator);
        $verification = $queryHandler->handle($query);
        $this->assertInstanceOf(Verification::class, $verification);
    }
}
