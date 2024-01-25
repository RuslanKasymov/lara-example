<?php

namespace App\Domain\Articles\Article\Application\DTO;

use App\Domain\Articles\Article\Domain\Models\Article;
use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *   schema="ArticleOutputDTO",
 *   type="object",
 *   @OA\Property(property="id", type="integer"),
 *   @OA\Property(property="name", type="string"),
 *   @OA\Property(property="text", type="string"),
 *   @OA\Property(property="status", ref="#/components/schemas/ArticleStatus"),
 * )
 */
class ArticleOutputDTO
{
    public int $id;
    public int $userId;
    public string $name;
    public string $text;
    public string $status;

    public static function fromArticle(Article $article): self
    {
        $obj = new self();
        $obj->id = $article->id;
        $obj->userId = $article->user_id;
        $obj->name = $article->name;
        $obj->text = $article->text;
        $obj->status = $article->status->value;

        return $obj;
    }
}
