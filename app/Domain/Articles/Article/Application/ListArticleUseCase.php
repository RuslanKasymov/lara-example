<?php

namespace App\Domain\Articles\Article\Application;

use App\Domain\Articles\Article\Application\DTO\ArticleOutputDTO;
use App\Domain\Articles\Article\Domain\IArticleRepository;
use App\Domain\Articles\Article\Domain\Models\Article;
use App\Domain\Articles\Article\Infrastructure\DTO\ArticlePaginationDTO;
use Illuminate\Support\Collection;

class ListArticleUseCase
{
    public function __construct(public readonly IArticleRepository $articleRepository)
    {
    }

    public function execute(ArticlePaginationDTO $dto): Collection
    {
        $articles = $this->articleRepository->list($dto);

        return $articles->map(function (Article $article) {
            return ArticleOutputDTO::fromArticle($article);
        });
    }
}
