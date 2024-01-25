<?php

namespace App\Domain\SharedKernel\Users\Contracts;

use App\Domain\Users\User\Domain\Models\User;

interface IUser
{
    public function getId(): int;
}
