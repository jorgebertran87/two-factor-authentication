<?php

declare(strict_types=1);

namespace Authenticator\Domain;

final class SpanishMobilePhoneNumber
{
    private const LENGTH = 9;
    private const PREFIX = '+34';
    private const FIRST_DIGIT = '6';

    private string $number;

    public function __construct(string $number)
    {
        $number = $this->sanitize($number);
        $this->validate($number);

        $this->number = self::PREFIX . $number;
    }

    private function sanitize(string $number): string {
        return str_replace("-", "", (filter_var($number, FILTER_SANITIZE_NUMBER_INT)));
    }

    private function validate(string $number): void {
        if (strlen($number) !== self::LENGTH) {
            throw InvalidSpanishMobilePhoneNumberException::create($number);
        }

        if ($number[0] !==  self::FIRST_DIGIT) {
            throw InvalidSpanishMobilePhoneNumberException::create($number);
        }
    }

    public function number(): string {
        return $this->number;
    }
}
