<?php
declare(strict_types=1);

namespace App\Domain\Model;

final class User
{
    private string $encodedPassword;

    private readonly string $id;

    public function __construct(private readonly string $email, string $encodedPassword)
    {
        $this->id = uniqid();
        $this->changePassword($encodedPassword);
    }

    public function id(): string
    {
        return $this->id;
    }

    public function email(): string
    {
        return $this->email;
    }

    public function changePassword(string $encodedPassword): void
    {
        $this->encodedPassword = $encodedPassword;
    }
}
