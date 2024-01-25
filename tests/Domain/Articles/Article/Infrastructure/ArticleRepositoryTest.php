<?php

namespace Tests\Domain\Articles\Article\Infrastructure;

use App\Domain\Articles\Article\Domain\Models\Article;
use App\Domain\Articles\Article\Infrastructure\ArticleRepository;
use App\Domain\Articles\Article\Infrastructure\DTO\ArticlePaginationDTO;
use App\Domain\Articles\Article\Infrastructure\DTO\CreateArticleDTO;
use App\Domain\Articles\Article\Infrastructure\DTO\UpdateArticleDTO;
use App\Domain\SharedKernel\Articles\Enums\ArticleStatus;
use App\Domain\Users\User\Domain\Models\User;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

/**
 * @coversDefaultClass \App\Domain\Articles\Article\Infrastructure\ArticleRepository
 */
class ArticleRepositoryTest extends TestCase
{
    private ArticleRepository $repository;

    public function setUp(): void
    {
        parent::setUp();
        $this->repository = new ArticleRepository();
    }

    /**
     * @covers ::create
     */
    public function testCreateArticle(): void
    {
        $user = User::factory()->create();

        $dto = new CreateArticleDTO('name', 'text', ArticleStatus::PUBLISHED, $user->id);

        $this->repository->create($dto);

        $this->assertDatabaseHas('articles', [
            'name' => $dto->name,
            'text' => $dto->text,
            'user_id' => $dto->userId,
            'status' => $dto->status->value,
        ]);
    }

    /**
     * @covers ::update
     */
    public function testUpdateArticle(): void
    {
        $article = Article::factory()->create();

        $dto = new UpdateArticleDTO('name', 'text', ArticleStatus::PUBLISHED);

        $this->repository->update($article->id, $dto);

        $this->assertDatabaseHas('articles', [
            'id' => $article->id,
            'name' => $dto->name,
            'text' => $dto->text,
            'status' => $dto->status->value,
        ]);
    }

    /**
     * @covers ::delete
     */
    public function testDeleteArticle(): void
    {
        $article = Article::factory()->create(['status' => ArticleStatus::PENDING]);

        $this->repository->delete($article->id);

        $this->assertDatabaseMissing('articles', ['id' => $article->id]);
    }

    /**
     * @covers ::get
     */
    public function testGetArticle(): void
    {
        $article = Article::factory()->create();

        $result = $this->repository->getById($article->id);

        $this->assertInstanceOf(Article::class, $result);
        $this->assertEquals($article->name, $result->name);
        $this->assertEquals($article->text, $result->text);
        $this->assertEquals($article->user_id, $result->user_id);
        $this->assertEquals($article->status->value, $result->status->value);
    }

    /**
     * @covers ::list
     */
    public function testListArticles(): void
    {
        $articleOne = Article::factory()->create();
        $articleTwo = Article::factory()->create();
        $articleThree = Article::factory()->create();

        $result = $this->repository->list(new ArticlePaginationDTO(null,10));

        $this->assertCount(3, $result);
        $this->assertTrue($result->contains('id', '=', $articleOne->id));
        $this->assertTrue($result->contains('id', '=', $articleTwo->id));
        $this->assertTrue($result->contains('id', '=', $articleThree->id));
    }

    /**
     * @covers ::list
     */
    public function testListPaginationAndLimitArticles(): void
    {
        Article::factory()->create();
        $articleTwo = Article::factory()->create();
        $articleThree = Article::factory()->create();

        $result = $this->repository->list(new ArticlePaginationDTO($articleThree->id,1));

        $this->assertCount(1, $result);
        $this->assertTrue($result->contains('id', '=', $articleTwo->id));
    }
}
