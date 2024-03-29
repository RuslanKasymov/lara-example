<?php

namespace App\Domain\SharedKernel\Utils\Enums;

trait EnumUtils
{
    public static function names(): array
    {
        return array_column(self::cases(), 'name');
    }

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }

    public static function array(): array
    {
        return array_combine(self::values(), self::names());
    }

    public static function hasValue(string $value): bool
    {
        return in_array($value, self::values());
    }

    public static function imploded(string $separator = ','): string
    {
        return implode($separator, self::values());
    }
}
