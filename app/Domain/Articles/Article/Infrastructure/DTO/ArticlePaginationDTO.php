<?php

namespace App\Domain\Articles\Article\Infrastructure\DTO;

use App\Domain\SharedKernel\Articles\Enums\ArticleStatus;

class ArticlePaginationDTO
{
    public function __construct(
        public ?int $paginationId,
        public int  $limit,
    ) {
    }
}
