<?php
declare(strict_types=1);

namespace App\Infrastructure\Storage\InMemory;

use App\Domain\Model\User;
use App\Domain\Model\Users;

final class InMemoryUsers implements Users
{
    private array $users = [];

    public function add(User $user)
    {
        $this->users[$user->id()] = $user;
    }
}
