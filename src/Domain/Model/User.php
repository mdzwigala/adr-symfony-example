<?php
declare(strict_types=1);

namespace App\Domain\Model;

final class User
{
    private string $email;

    private string $encodedPassword;

    private string $id;

    public function __construct(string $email, string $encodedPassword)
    {
        $this->id = uniqid();
        $this->email = $email;
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
