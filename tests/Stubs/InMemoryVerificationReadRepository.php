<?php

declare(strict_types=1);

namespace Tests\Stubs;

use Authenticator\Application\VerificationReadRepository;
use Authenticator\Domain\Verification;

final class InMemoryVerificationReadRepository implements VerificationReadRepository {

    private array $verifications;

    public function findById(string $id): ?Verification
    {
        return $this->verifications[0];
    }

    public function findByIdAndCode(string $id, string $code): ?Verification
    {
        return $this->verifications[0];
    }

    public function add(Verification $verification): void {
        $this->verifications[] = $verification;
    }
}
