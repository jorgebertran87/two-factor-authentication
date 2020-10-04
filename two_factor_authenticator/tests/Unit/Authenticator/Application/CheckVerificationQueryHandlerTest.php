<?php

declare(strict_types = 1);

namespace Tests\Unit\Authenticator\Application;

use App\Authenticator\Application\CheckVerificationQuery;
use App\Authenticator\Application\CheckVerificationQueryHandler;
use App\Authenticator\Domain\Verification;
use PHPUnit\Framework\TestCase;
use Tests\Stubs\FakeCodeValidator;
use Tests\Stubs\FakeVerification;
use Tests\Stubs\FakeVerificationWriteRepository;
use Tests\Stubs\InMemoryVerificationReadRepository;

class CheckVerificationQueryHandlerTest extends TestCase
{
    /** @test */
    public function itShouldRetrieveAValidVerification() {
        $readRepository = new InMemoryVerificationReadRepository();
        $writeRepository = new FakeVerificationWriteRepository();
        $verification = FakeVerification::create();
        $readRepository->add($verification);
        $codeValidator = new FakeCodeValidator();
        $query = new CheckVerificationQuery('111111', 'code');
        $queryHandler = new CheckVerificationQueryHandler($readRepository, $writeRepository, $codeValidator);
        $verification = $queryHandler->handle($query);
        $this->assertInstanceOf(Verification::class, $verification);
    }
}
