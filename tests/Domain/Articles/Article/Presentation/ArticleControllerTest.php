<?php

namespace Tests\Domain\Articles\Article\Presentation;

use App\Domain\Articles\Article\Domain\Models\Article;
use App\Domain\SharedKernel\Articles\Enums\ArticleStatus;
use App\Domain\Users\User\Domain\Models\User;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

/**
 * @coversDefaultClass \App\Domain\Articles\Article\Presentation\ArticleController
 */
class ArticleControllerTest extends TestCase
{
    /**
     * @covers ::create
     */
    public function testCreateArticle(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->postJson('/api/articles/', [
            'name' => 'Article name',
            'text' => 'Some article text',
            'status' => ArticleStatus::PUBLISHED->value,
        ]);

        $response->assertStatus(Response::HTTP_CREATED)
            ->assertJson([
                'name' => 'Article name',
                'text' => 'Some article text',
                'userId' => $user->id,
                'status' => ArticleStatus::PUBLISHED->value,
            ]);

        $this->assertDatabaseHas('articles', [
            'name' => 'Article name',
            'text' => 'Some article text',
            'user_id' => $user->id,
            'status' => ArticleStatus::PUBLISHED->value,
        ]);
    }

    /**
     * @covers ::update
     */
    public function testUpdateArticle(): void
    {
        $user = User::factory()->create();
        $article = Article::factory()->create(['user_id' => $user->id,'status' => ArticleStatus::PENDING]);

        $response = $this->actingAs($user)->putJson('/api/articles/'.$article->id, [
            'name' => 'Article name',
            'text' => 'Some article text',
            'status' => ArticleStatus::PUBLISHED->value,
        ]);

        $response->assertStatus(Response::HTTP_OK)
            ->assertJson([
                'name' => 'Article name',
                'text' => 'Some article text',
                'userId' => $user->id,
                'status' => ArticleStatus::PUBLISHED->value,
            ]);

        $this->assertDatabaseHas('articles', [
            'id' => $article->id,
            'name' => 'Article name',
            'text' => 'Some article text',
            'user_id' => $user->id,
            'status' => ArticleStatus::PUBLISHED->value,
        ]);
    }

    /**
     * @covers ::delete
     */
    public function testDeleteArticle(): void
    {
        $user = User::factory()->create();
        $article = Article::factory()->create(['status' => ArticleStatus::PENDING]);

        $response = $this->actingAs($user)->deleteJson('/api/articles/'.$article->id);

        $response->assertStatus(Response::HTTP_NO_CONTENT);

        $this->assertDatabaseMissing('articles', ['id' => $article->id]);
    }

    /**
     * @covers ::get
     */
    public function testGetArticle(): void
    {
        $article = Article::factory()->create();

        $response = $this->getJson('/api/articles/'.$article->id);

        $response->assertStatus(Response::HTTP_OK)
            ->assertJson([
                'name' => $article->name,
                'text' => $article->text,
                'userId' => $article->user_id,
                'status' => $article->status->value,
            ]);
    }

    /**
     * @covers ::list
     */
    public function testListArticles(): void
    {
        $user = User::factory()->create();
        $articleOne = Article::factory()->create();
        $articleTwo = Article::factory()->create();
        $articleThree = Article::factory()->create();

        $response = $this->actingAs($user)->getJson('/api/articles');

        $response->assertStatus(Response::HTTP_OK)
            ->assertJson([
                [
                    'id' => $articleThree->id,
                ],
                [
                    'id' => $articleTwo->id,
                ],
                [
                    'id' => $articleOne->id,
                ]
            ]);
    }
}
