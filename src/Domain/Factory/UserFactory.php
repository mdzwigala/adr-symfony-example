<?php
declare(strict_types=1);

namespace App\Domain\Factory;

use App\Action\Input\AddUserInput;
use App\Domain\Model\User;
use App\Domain\Service\PasswordEncoder;

final class UserFactory
{
    private PasswordEncoder $passwordEncoder;

    public function __construct(PasswordEncoder $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }
    public function fromAddUserInput(AddUserInput $input): User
    {
        return new User(
            $input->getEmail(),
            $this->passwordEncoder->encode($input->getPassword())
        );
    }
}
