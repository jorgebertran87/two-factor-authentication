<?php

declare(strict_types=1);

namespace Authenticator\Domain;

final class Code
{
    public function __construct(CodeGenerator $codeGenerator)
    {
        $this->value = $codeGenerator->generate();
    }

    public function __toString(): string
    {
        return $this->value;
    }
}
