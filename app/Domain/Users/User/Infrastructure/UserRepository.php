<?php

namespace App\Domain\Users\User\Infrastructure;

use App\Domain\Users\User\Domain\IUserRepository;
use App\Domain\Users\User\Domain\Models\User;
use Ramsey\Collection\Collection;

class UserRepository implements IUserRepository
{
    public function getByIds(array $ids): Collection
    {
        return User::whereIn('id', $ids)->get();
    }
}
