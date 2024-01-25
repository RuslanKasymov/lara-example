<?php

namespace App\Domain\Articles\Article\Infrastructure\DTO;

use App\Domain\SharedKernel\Articles\Enums\ArticleStatus;

class UpdateArticleDTO
{
    public function __construct(
        public string        $name,
        public string        $text,
        public ArticleStatus $status,
    ) {
    }
}
