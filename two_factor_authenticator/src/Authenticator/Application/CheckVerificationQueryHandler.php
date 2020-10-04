<?php

declare(strict_types=1);

namespace App\Authenticator\Application;

use App\Authenticator\Domain\Code;
use DateTimeImmutable;

final class CheckVerificationQueryHandler implements QueryHandler
{
    private VerificationReadRepository $verificationReadRepository;
    private CodeValidator $codeValidator;

    public function __construct(
        VerificationReadRepository $verificationReadRepository,
        CodeValidator $codeValidator
    ) {
        $this->verificationReadRepository = $verificationReadRepository;
        $this->codeValidator = $codeValidator;

    }

    public function handle($query)
    {
        $now = new DateTimeImmutable();
        $code = new Code($query->code(), $now);

        if ($code->isMaster()) {
            $verification = $this->verificationReadRepository->findById($query->id());
            return $verification;
        }

        $this->codeValidator->validate($code);
        $verification = $this->verificationReadRepository->findByIdAndCode($query->id(), $code->value());
        return $verification;


    }
}