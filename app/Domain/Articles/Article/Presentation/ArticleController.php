<?php

namespace App\Domain\Articles\Article\Presentation;

use App\Domain\Articles\Article\Application\CreateArticleUseCase;
use App\Domain\Articles\Article\Application\DeleteArticleUseCase;
use App\Domain\Articles\Article\Application\GetArticleUseCase;
use App\Domain\Articles\Article\Application\ListArticleUseCase;
use App\Domain\Articles\Article\Application\UpdateArticleUseCase;
use App\Domain\Articles\Article\Presentation\Requests\CreateArticleRequest;
use App\Domain\Articles\Article\Presentation\Requests\ListArticleRequest;
use App\Domain\Articles\Article\Presentation\Requests\UpdateArticleRequest;
use App\Domain\SharedKernel\Users\IUserService;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller as BaseController;
use Symfony\Component\HttpFoundation\Response;

class ArticleController extends BaseController
{
    /**
     * @OA\Post(
     *      path="api/v1/articles",
     *      operationId="addArticle",
     *      tags={"article"},
     *      summary="Add new article",
     *      @OA\Parameter(
     *         name="Authorization",
     *         in="header",
     *         required=true,
     *         description="Bearer {access-token}",
     *         @OA\Schema(type="string")
     *      ),
     *      @OA\RequestBody(
     *        @OA\JsonContent(ref="#/components/schemas/AddArticleRequest")
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Success",
     *          @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="data", ref="#/components/schemas/ArticleDTO")
     *          )
     *      ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthorized",
     *      ),
     *      @OA\Response(
     *          response=400,
     *          description="Code | Description  <br>
     * SERVER_ERROR | Server error",
     *          @OA\JsonContent(ref="#/components/schemas/Error")
     *      )
     *  )
     */
    public function create(CreateArticleRequest $request, CreateArticleUseCase $useCase, IUserService $userService): JsonResponse
    {
        $result = $useCase->execute($request->toDto($userService->getAuthorizedUser()));

        return response()->json($result, Response::HTTP_CREATED);
    }

    public function update(int $articleId, UpdateArticleRequest $request, UpdateArticleUseCase $useCase): JsonResponse
    {
        $result = $useCase->execute($articleId, $request->toDto());

        return response()->json($result);
    }

    public function delete(int $articleId, DeleteArticleUseCase $useCase): JsonResponse
    {
        $useCase->execute($articleId);

        return response()->json([],Response::HTTP_NO_CONTENT);
    }

    public function get(int $articleId, GetArticleUseCase $useCase): JsonResponse
    {
        $result = $useCase->execute($articleId);

        return response()->json($result);
    }

    public function list(ListArticleRequest $request, ListArticleUseCase $useCase): JsonResponse
    {
        $result = $useCase->execute($request->toDto());

        return response()->json($result->toArray());
    }
}
