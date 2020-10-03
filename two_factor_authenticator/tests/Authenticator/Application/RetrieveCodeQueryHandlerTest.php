<?php

declare(strict_types = 1);

namespace Tests\Authenticator\Application;

use App\Authenticator\Application\RandomAlphanumericCodeGenerator;
use App\Authenticator\Application\RetrieveCodeQuery;
use App\Authenticator\Application\RetrieveCodeQueryHandler;
use App\Authenticator\Application\Uuid5Generator;
use App\Authenticator\Domain\Verification;
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
