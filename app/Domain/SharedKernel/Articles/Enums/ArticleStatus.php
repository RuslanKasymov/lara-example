<?php

namespace App\Domain\SharedKernel\Articles\Enums;

use App\Domain\SharedKernel\Utils\Enum\EnumUtils;

enum ArticleStatus: string
{
    use EnumUtils;
    case PENDING = 'pending';
    case PUBLISHED = 'published';
}
