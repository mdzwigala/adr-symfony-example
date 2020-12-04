<?php
declare(strict_types=1);

namespace App\Domain\Model;

interface Users
{
    public function add(User $user);
}
