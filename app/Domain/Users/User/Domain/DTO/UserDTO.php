<?php

namespace App\Domain\Users\User\Domain\DTO;

use App\Domain\SharedKernel\Users\Contracts\IUser;

class UserDTO implements IUser
{
    public function __construct(
        private readonly int $id,
    ) {
    }

    public function getId(): int
    {
        return $this->id;
    }
}
