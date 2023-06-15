<?php

namespace App\ValueObjects;

readonly final class Author
{
    public function __construct(
        public ?string $uuid,
        public ?string $name,
    ) {}

    public static function from(array $attributes): self
    {
        return new self(
            uuid: $attributes['uuid'],
            name: $attributes['name'],
        );
    }
}
