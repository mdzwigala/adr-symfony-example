<?php
declare(strict_types=1);

namespace App\Infrastructure\Service;

use App\Domain\Service\PasswordEncoder;

final class Md5PasswordEncoder implements PasswordEncoder
{
    public function __construct(private readonly string $salt)
    {
    }

    public function encode(string $password): string
    {
        return md5($this->salt . $password);
    }

    public function matches(string $givenPassword, string $password): bool
    {
        return $this->encode($givenPassword) === $password;
    }
}
