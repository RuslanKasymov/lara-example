<?php

namespace App\Domain\Articles\Article\Presentation\Requests;

use App\Domain\Articles\Article\Infrastructure\DTO\CreateArticleDTO;
use App\Domain\SharedKernel\Articles\Enums\ArticleStatus;
use App\Domain\SharedKernel\Users\Contracts\IUser;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CreateArticleRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'min:10', 'max:255'],
            'text' => ['required', 'string', 'min:4', 'max:2000'],
            'status' => ['required', 'string', Rule::in(ArticleStatus::values())]
        ];
    }

    public function toDto(IUser $user): CreateArticleDTO
    {
        return new CreateArticleDTO(
            $this->input('name'),
            $this->input('text'),
            ArticleStatus::from($this->input('status')),
            $user->getId()
        );
    }
}
