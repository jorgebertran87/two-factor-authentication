<?php

declare(strict_types = 1);

namespace Tests\Authenticator\Application;

use Authenticator\Application\CheckVerificationQuery;
use Authenticator\Application\CheckVerificationQueryHandler;
use Authenticator\Domain\Verification;
use PHPUnit\Framework\TestCase;
use Tests\Stubs\FakeCodeValidator;
use Tests\Stubs\FakeVerification;
use Tests\Stubs\InMemoryVerificationReadRepository;

class CheckVerificationQueryHandlerTest extends TestCase
{
    /** @test */
    public function itShouldRetrieveAValidVerification() {
        $repository = new InMemoryVerificationReadRepository();
        $verification = new FakeVerification();
        $repository->add($verification);
        $codeValidator = new FakeCodeValidator();
        $query = new CheckVerificationQuery('111111', 'code');
        $queryHandler = new CheckVerificationQueryHandler($repository, $codeValidator);
        $verification = $queryHandler->handle($query);
        $this->assertInstanceOf(Verification::class, $verification);
    }
}
