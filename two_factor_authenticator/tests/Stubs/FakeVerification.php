<?php

declare(strict_types=1);

namespace Tests\Stubs;

use App\Authenticator\Domain\Code;
use App\Authenticator\Domain\Id;
use App\Authenticator\Domain\Phone;
use App\Authenticator\Domain\Verification;
use DateTimeImmutable;

final class FakeVerification extends Verification {
    public static function create(): self {
        $id = new Id('1');
        $now = new DateTimeImmutable();
        $code = new Code('111', $now);
        $phone = new Phone('611 11 11 11');

        return new static($id, $code, $phone);
    }
}
