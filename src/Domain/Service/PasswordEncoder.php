<?php
declare(strict_types=1);

namespace App\Domain\Service;

interface PasswordEncoder
{
    public function encode(string $password): string;

    public function matches(string $givenPassword, string $password): bool;
}
