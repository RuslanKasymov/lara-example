<?php

namespace App\Domain\Articles\Article\Presentation\Requests;

use App\Domain\Articles\Article\Infrastructure\DTO\CreateArticleDTO;
use App\Domain\Articles\Article\Infrastructure\DTO\UpdateArticleDTO;
use App\Domain\SharedKernel\Articles\Enums\ArticleStatus;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateArticleRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'min:10', 'max:255'],
            'text' => ['required', 'string', 'min:4', 'max:2000'],
            'status' => ['required', 'string', Rule::in(ArticleStatus::values())]
        ];
    }

    public function toDto(): UpdateArticleDTO
    {
        return new UpdateArticleDTO(
            $this->input('name'),
            $this->input('text'),
            ArticleStatus::from($this->input('status')),
        );
    }
}
