<?php

namespace App\Domain\Articles\Article\Application;

use App\Domain\Articles\Article\Application\DTO\ArticleOutputDTO;
use App\Domain\Articles\Article\Domain\IArticleRepository;
use App\Domain\Articles\Article\Infrastructure\DTO\UpdateArticleDTO;

class DeleteArticleUseCase
{
    public function __construct(public readonly IArticleRepository $articleRepository)
    {
    }

    public function execute(int $articleId): void
    {
        // TODO: add check article exists
        // TODO: add check is author

        $this->articleRepository->delete($articleId);
    }
}
