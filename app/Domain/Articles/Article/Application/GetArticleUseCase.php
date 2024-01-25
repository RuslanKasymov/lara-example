<?php

namespace App\Domain\Articles\Article\Application;

use App\Domain\Articles\Article\Application\DTO\ArticleOutputDTO;
use App\Domain\Articles\Article\Domain\IArticleRepository;
use App\Domain\Articles\Article\Infrastructure\DTO\UpdateArticleDTO;

class GetArticleUseCase
{
    public function __construct(public readonly IArticleRepository $articleRepository)
    {
    }

    public function execute(int $articleId): ArticleOutputDTO
    {
        // TODO: add check article exists

        return ArticleOutputDTO::fromArticle($this->articleRepository->getById($articleId));
    }
}
