<?php
declare(strict_types=1);

namespace App\Action\Output;

final class AddUserOutput
{
    public function __construct(private readonly string $userId)
    {
    }

    public function getUserId(): string
    {
        return $this->userId;
    }
}
