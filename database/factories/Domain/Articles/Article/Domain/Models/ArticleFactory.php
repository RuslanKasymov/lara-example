<?php

namespace Database\Factories\Domain\Articles\Article\Domain\Models;

use App\Domain\Articles\Article\Domain\Models\Article;
use App\Domain\SharedKernel\Articles\Enums\ArticleStatus;
use App\Domain\Users\User\Domain\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class ArticleFactory extends Factory
{
    protected $model = Article::class;

    public function definition(): array
    {
        return [
            'name' => fake()->text(50),
            'text' => fake()->text(),
            'status' => ArticleStatus::PUBLISHED,
            'user_id' => User::factory()->create()->id,
        ];
    }
}
