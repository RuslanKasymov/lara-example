<?php

namespace App\Domain\SharedKernel\Users;

use App\Domain\SharedKernel\Users\Contracts\IUser;

interface IUserService
{
    public function getAuthorizedUser(): ?IUser;
}
