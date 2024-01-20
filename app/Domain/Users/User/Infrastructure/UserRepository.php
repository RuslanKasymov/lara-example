<?php

namespace App\Domain\Users\User\Infrastructure;

use App\Domain\Users\User\Domain\IUserRepository;
use App\Domain\Users\User\Domain\Model\User;

class UserRepository implements IUserRepository
{
    public function getById(int $id): User
    {
        return User::find($id);
    }
}
