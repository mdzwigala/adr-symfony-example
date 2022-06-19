<?php
declare(strict_types=1);

namespace App\Domain\Factory;

use App\Action\Input\AddUserInput;
use App\Domain\Model\User;
use App\Domain\Service\PasswordEncoder;

final class UserFactory
{
    public function __construct(private readonly PasswordEncoder $passwordEncoder)
    {
    }
    public function fromAddUserInput(AddUserInput $input): User
    {
        return new User(
            $input->getEmail(),
            $this->passwordEncoder->encode($input->getPassword())
        );
    }
}
