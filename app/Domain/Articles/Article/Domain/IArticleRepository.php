<?php

namespace App\Domain\Articles\Article\Domain;

use App\Domain\Articles\Article\Domain\Models\Article;
use App\Domain\Articles\Article\Infrastructure\DTO\ArticlePaginationDTO;
use App\Domain\Articles\Article\Infrastructure\DTO\CreateArticleDTO;
use App\Domain\Articles\Article\Infrastructure\DTO\UpdateArticleDTO;
use Illuminate\Support\Collection;

interface IArticleRepository
{
    public function getById(int $id): Article;

    public function create(CreateArticleDTO $dto): Article;

    public function update(int $articleId, UpdateArticleDTO $dto): void;

    public function delete(int $articleId): void;

    public function list(ArticlePaginationDTO $dto): Collection;
}
