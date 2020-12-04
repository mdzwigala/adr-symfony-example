<?php
declare(strict_types=1);

namespace App\Infrastructure\Service;

use App\Domain\Service\PasswordEncoder;

final class Md5PasswordEncoder implements PasswordEncoder
{
    private string $salt;

    public function __construct(string $salt)
    {
        $this->salt = $salt;
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
