<?php

declare(strict_types=1);

namespace Authenticator\Application;

use Authenticator\Domain\Phone;
use Authenticator\Domain\Verification;

final class RetrieveCodeQueryHandler implements QueryHandler
{
    private VerificationWriteRepository $verificationWriteRepository;
    private IdGenerator $idGenerator;
    private CodeGenerator $codeGenerator;

    public function __construct(
        VerificationWriteRepository $verificationWriteRepository,
        IdGenerator $idGenerator,
        CodeGenerator $codeGenerator
    ) {
        $this->verificationWriteRepository = $verificationWriteRepository;
        $this->idGenerator = $idGenerator;
        $this->codeGenerator = $codeGenerator;
    }

    public function handle($query)
    {
        $id = $this->idGenerator->generate();
        $code = $this->codeGenerator->generate();
        $phone = new Phone($query->phoneNumber());

        $verification = new Verification($id, $code, $phone);
        $this->verificationWriteRepository->save($verification);

        return $verification;
    }
}
