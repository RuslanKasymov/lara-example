<?php

namespace App\Domain\Articles\Article\Application;

use App\Domain\Articles\Article\Application\DTO\ArticleOutputDTO;
use App\Domain\Articles\Article\Domain\IArticleRepository;
use App\Domain\Articles\Article\Infrastructure\DTO\CreateArticleDTO;

class CreateArticleUseCase
{
    public function __construct(public readonly IArticleRepository $articleRepository)
    {
    }

    public function execute(CreateArticleDTO $dto): ArticleOutputDTO
    {
        return ArticleOutputDTO::fromArticle($this->articleRepository->create($dto));
    }
}
