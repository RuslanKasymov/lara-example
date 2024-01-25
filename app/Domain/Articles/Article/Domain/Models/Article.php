<?php

namespace App\Domain\Articles\Article\Domain\Models;

use App\Domain\SharedKernel\Articles\Enums\ArticleStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

/**
 * @property int $id
 * @property int $user_id
 * @property string $name
 * @property string $text
 * @property ArticleStatus $status
 */
class Article extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'text',
        'status',
        'user_id',
    ];

    protected $casts = [
        'status' => ArticleStatus::class,
    ];
}
