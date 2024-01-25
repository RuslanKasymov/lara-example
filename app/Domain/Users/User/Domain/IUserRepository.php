<?php

namespace App\Domain\Users\User\Domain;

use App\Domain\Users\User\Domain\Models\User;
use Ramsey\Collection\Collection;

interface IUserRepository
{
    public function getByIds(array $ids): Collection;
}
