<?php

namespace App\Domain\Users\User\Application;

use App\Domain\Users\User\Application\DTO\UserOutputDTO;
use App\Domain\Users\User\Domain\IUserRepository;

class GetUserUseCase
{
    public function __construct(public readonly IUserRepository $userRepository)
    {
    }

    public function execute(int $userId): UserOutputDTO
    {
        return UserOutputDTO::fromUser($this->userRepository->getByIds([$userId])->first());
    }
}
