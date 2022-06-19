<?php
declare(strict_types=1);

namespace App\Action\Input;

use Symfony\Component\Validator\Constraints as Assert;

final class AddUserInput
{
    public function __construct(
        #[Assert\NotBlank] private readonly string $email,
        #[Assert\Length(min: 6)] private readonly string $password
    )
    {
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
