<?php

namespace App\Domain\Articles\Article;

use App\Domain\Articles\Article\Domain\IArticleRepository;
use App\Domain\Articles\Article\Infrastructure\ArticleRepository;
use Illuminate\Support\ServiceProvider;

class ArticleServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(IArticleRepository::class, ArticleRepository::class);
    }
}
