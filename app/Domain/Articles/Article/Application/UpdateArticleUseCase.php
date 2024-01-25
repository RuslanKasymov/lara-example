<?php

namespace App\Domain\Articles\Article\Application;

use App\Domain\Articles\Article\Application\DTO\ArticleOutputDTO;
use App\Domain\Articles\Article\Domain\IArticleRepository;
use App\Domain\Articles\Article\Infrastructure\DTO\UpdateArticleDTO;

class UpdateArticleUseCase
{
    public function __construct(public readonly IArticleRepository $articleRepository)
    {
    }

    public function execute(int $articleId, UpdateArticleDTO $dto): ArticleOutputDTO
    {
        // TODO: add check article exists
        // TODO: add check is author

        $this->articleRepository->update($articleId, $dto);

        $article = $this->articleRepository->getById($articleId);

        return ArticleOutputDTO::fromArticle($article);
    }
}
