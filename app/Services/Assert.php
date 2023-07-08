<?php

namespace App\Services;

use Illuminate\Support\Str;
use App\Exceptions\AssertException;

class Assert
{
    public static function nonEmptyString(string $value): void
    {
        $length = Str::length($value);

        if ($length === 0) {
            throw new AssertException('string cannot be empty');
        }
    }
}
