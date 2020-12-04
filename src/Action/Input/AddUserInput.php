<?php
declare(strict_types=1);

namespace App\Action\Input;

use Symfony\Component\Validator\Constraints as Assert;

final class AddUserInput
{
    /** @Assert\NotBlank() */
    private string $email;

    /** @Assert\Length(min=6) */
    private string $password;

    public function __construct(string $email, string $password)
    {
        $this->email = $email;
        $this->password = $password;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getPassword(): string
    {
        return $this->password;
    }
}
