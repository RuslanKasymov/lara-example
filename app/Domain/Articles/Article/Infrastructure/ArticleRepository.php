<?php

namespace App\Domain\Articles\Article\Infrastructure;

use App\Domain\Articles\Article\Domain\IArticleRepository;
use App\Domain\Articles\Article\Domain\Models\Article;
use App\Domain\Articles\Article\Infrastructure\DTO\ArticlePaginationDTO;
use App\Domain\Articles\Article\Infrastructure\DTO\CreateArticleDTO;
use App\Domain\Articles\Article\Infrastructure\DTO\UpdateArticleDTO;
use App\Domain\SharedKernel\Articles\Enums\ArticleStatus;
use Illuminate\Support\Collection;

class ArticleRepository implements IArticleRepository
{
    public function getById(int $id): Article
    {
        return Article::find($id);
    }

    public function create(CreateArticleDTO $dto): Article
    {
        return Article::create([
            'name' => $dto->name,
            'text' => $dto->text,
            'status' => $dto->status,
            'user_id' => $dto->userId,
        ]);
    }

    public function update(int $articleId, UpdateArticleDTO $dto): void
    {
        Article::where('id', $articleId)->update([
            'name' => $dto->name,
            'text' => $dto->text,
            'status' => $dto->status,
        ]);
    }

    public function delete(int $articleId): void
    {
        Article::where('id', $articleId)->delete();
    }

    public function list(ArticlePaginationDTO $dto): Collection
    {
        $query = Article::query()
            ->where('status', ArticleStatus::PUBLISHED->value);

        if ($dto->paginationId) {
            $query->where('id', '<', $dto->paginationId);
        }

        return $query->limit($dto->limit)
            ->orderBy('id', 'desc')
            ->get();
    }
}
