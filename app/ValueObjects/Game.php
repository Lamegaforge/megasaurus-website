<?php

namespace App\ValueObjects;

readonly final class Game
{
    public function __construct(
        public ?string $externalId,
        public ?string $name,
    ) {}

    public static function from(array $attributes): self
    {
        return new self(
            externalId: $attributes['external_id'],
            name: $attributes['name'],
        );
    }
}
