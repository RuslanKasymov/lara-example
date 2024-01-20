<?php

namespace App\Domain\Users\User\Application\DTO;

use App\Domain\Users\User\Domain\Model\User;

class UserOutputDTO
{
    public string $name;

    public string $email;

    public static function fromUser(User $user): self
    {
        $obj = new self();
        $obj->name = $user->name;
        $obj->email = $user->email;

        return $obj;
    }
}
