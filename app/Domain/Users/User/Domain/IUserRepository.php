<?php

namespace App\Domain\Users\User\Domain;

use App\Domain\Users\User\Domain\Model\User;

interface IUserRepository
{
    public function getById(int $id): User;
}
