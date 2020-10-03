<?php

namespace Authenticator\Domain;

interface CodeGenerator {
    public function generate(): string;
}
