<?php

namespace App\Casts;

use App\Domain\SharedKernel\Utils\ValueObjects\Uuid;
use Illuminate\Contracts\Database\Eloquent\CastsAttributes;
use InvalidArgumentException;

class UuidCasts implements CastsAttributes
{
    public function get($model, string $key, $value, array $attributes)
    {
        if (is_null($value)) {
            return null;
        }

        return new Uuid($value);
    }

    public function set($model, string $key, $value, array $attributes)
    {
        if (is_null($value)) {
            return null;
        }

        if (!($value instanceof Uuid)) {
            throw new InvalidArgumentException();
        }

        return $value->value();
    }
}
