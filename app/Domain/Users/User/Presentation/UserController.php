<?php

namespace App\Domain\Users\User\Presentation;

use App\Domain\Users\User\Application\GetUserUseCase;
use App\Domain\Users\User\Presentation\Requests\GetUserRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller as BaseController;

class UserController extends BaseController
{
    public function getUser(int $id, GetUserRequest $request, GetUserUseCase $useCase): JsonResponse
    {
        $result = $useCase->execute($id);

        return response()->json($result);
    }
}
