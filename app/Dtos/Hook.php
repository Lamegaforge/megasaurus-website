<?php

namespace App\Dtos;

use Stringable;

readonly final class Hook implements Stringable
{
    public function __construct(
        public string $value,
    ) {}

    public function __toString(): string
    {
        return $this->value;
    }
}
