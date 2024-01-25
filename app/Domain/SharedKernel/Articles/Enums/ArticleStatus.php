<?php

namespace App\Domain\SharedKernel\Articles\Enums;

use App\Domain\SharedKernel\Utils\Enum\EnumUtils;
use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *   schema="ArticleStatus",
 *   type="string",
 *   enum={
 *     "pending",
 *     "published"
 *   }
 * )
 */
enum ArticleStatus: string
{
    use EnumUtils;

    case PENDING = 'pending';
    case PUBLISHED = 'published';
}
