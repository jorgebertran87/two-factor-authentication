<?php

declare(strict_types=1);

namespace App\Authenticator\Application;

use App\Authenticator\Domain\Id;

final class Uuid5Generator implements IdGenerator
{
    public const LENGTH = 4;

    private const PERMITTED_CHARS = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';

    public function generate(): Id
    {
        $uuid = \uniqid();

        return new Id($uuid);
    }
}
