<?php

declare(strict_types=1);

namespace App\Exceptions;

use Exception;
use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *   schema="Error",
 *   type="object",
 *   @OA\Property(
 *     property="status",
 *     type="string"
 *   ),
 *   @OA\Property(
 *     property="errors",
 *     type="array",
 *     @OA\Items(
 *          type="object",
 *          @OA\Property(
 *              property="message",
 *              type="string"
 *          )
 *     )
 *  )
 * )
 */
class BusinessLogicException extends Exception {}
