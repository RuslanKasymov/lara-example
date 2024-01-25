<?php

namespace App\Domain\Articles\Article\Presentation\Requests;

use App\Domain\Articles\Article\Infrastructure\DTO\ArticlePaginationDTO;
use Illuminate\Foundation\Http\FormRequest;

class ListArticleRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'pagination_id' => ['integer', 'nullable', 'min:1'],
            'limit' => ['integer', 'nullable', 'min:1', 'max:20']
        ];
    }

    public function toDTO(): ArticlePaginationDTO
    {
        return new ArticlePaginationDTO(
            $this->query('pagination_id'),
            $this->query('limit', 10),
        );
    }
}
