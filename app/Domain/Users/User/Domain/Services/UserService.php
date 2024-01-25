<?php

 namespace App\Domain\Users\User\Domain\Services;

 use App\Domain\SharedKernel\Users\Contracts\IUser;
 use App\Domain\SharedKernel\Users\IUserService;
 use App\Domain\Users\User\Domain\DTO\UserDTO;
 use Illuminate\Support\Facades\Auth;

 class UserService implements IUserService
 {

     public function getAuthorizedUser(): ?IUser
     {
         return new UserDTO(
             Auth::user()->id
         );
     }
 }
