<?php

declare(strict_types=1);

namespace App\Authenticator\Application;

use App\Authenticator\Domain\Code;
use DateTimeImmutable;

final class CheckVerificationQueryHandler implements QueryHandler
{
    private VerificationReadRepository $verificationReadRepository;
    private VerificationWriteRepository $verificationWriteRepository;
    private CodeValidator $codeValidator;

    public function __construct(
        VerificationReadRepository $verificationReadRepository,
        VerificationWriteRepository $verificationWriteRepository,
        CodeValidator $codeValidator
    ) {
        $this->verificationReadRepository = $verificationReadRepository;
        $this->verificationWriteRepository = $verificationWriteRepository;
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

        $verification = $this->verificationReadRepository->findByIdAndCode($query->id(), $code->value());
        if (null === $verification) {
            throw CodeNotFoundException::create($query->code());
        }

        $code = $verification->code();
        $this->codeValidator->validate($code);
        $this->verificationWriteRepository->markAsUsed($verification);

        return $verification;
    }
}
