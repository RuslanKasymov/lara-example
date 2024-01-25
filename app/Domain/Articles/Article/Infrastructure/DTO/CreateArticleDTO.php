<?php

namespace App\Domain\Articles\Article\Infrastructure\DTO;

use App\Domain\SharedKernel\Articles\Enums\ArticleStatus;

class CreateArticleDTO
{
    public function __construct(
        public string        $name,
        public string        $text,
        public ArticleStatus $status,
        public int $userId,
    ) {
    }
}
