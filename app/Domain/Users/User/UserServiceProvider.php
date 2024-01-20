<?php

namespace App\Domain\Users\User;

use App\Domain\Users\User\Domain\IUserRepository;
use App\Domain\Users\User\Infrastructure\UserRepository;
use Illuminate\Support\ServiceProvider;

class UserServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(IUserRepository::class, UserRepository::class);
    }
}
