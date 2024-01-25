<?php

namespace Tests\Domain\Articles\Article\Application;

use App\Domain\Articles\Article\Application\CreateArticleUseCase;
use App\Domain\Articles\Article\Application\DTO\ArticleOutputDTO;
use App\Domain\Articles\Article\Domain\IArticleRepository;
use App\Domain\Articles\Article\Domain\Models\Article;
use App\Domain\Articles\Article\Infrastructure\DTO\CreateArticleDTO;
use App\Domain\SharedKernel\Articles\Enums\ArticleStatus;
use App\Domain\Users\User\Domain\Models\User;
use Mockery;
use Mockery\MockInterface;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

/**
 * @coversDefaultClass \App\Domain\Articles\Article\Application\CreateArticleUseCase
 */
class CreateArticleUseCaseTest extends TestCase
{
    private MockInterface|IArticleRepository $articleRepository;
    private CreateArticleUseCase $useCase;

    public function setUp(): void
    {
        parent::setUp();
        $this->articleRepository = Mockery::mock(IArticleRepository::class);

        $this->useCase = new CreateArticleUseCase($this->articleRepository);
    }

    /**
     * @covers ::execute
     */
    public function testCreateArticle(): void
    {
        $dto = new CreateArticleDTO(
            'Some name',
            'Some article text',
            ArticleStatus::PUBLISHED,
            rand(1,10)
        );

        $article = Article::factory()->makeOne([
            'id' => rand(11,20),
            'name' => $dto->name,
            'text' => $dto->text,
            'status' => $dto->status,
            'user_id' => $dto->userId,
        ]);

        $this->articleRepository->shouldReceive('create')
            ->once()
            ->with($dto)
            ->andReturn($article);

        $result = $this->useCase->execute($dto);

        $this->assertInstanceOf(ArticleOutputDTO::class, $result);
        $this->assertEquals($article->id, $result->id);
        $this->assertEquals($dto->userId, $result->userId);
        $this->assertEquals($dto->name, $result->name);
        $this->assertEquals($dto->text, $result->text);
        $this->assertEquals($dto->status->value, $result->status);
    }
}
