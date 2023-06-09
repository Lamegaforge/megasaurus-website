<?php

namespace App\ValueObjects;

readonly final class Game
{
    public function __construct(
        public string $uuid,
        public ?string $externalId,
        public ?string $name,
        public ?int $activeClipsCount,
    ) {}

    public static function from(array $attributes): self
    {
        return new self(
            uuid: $attributes['uuid'],
            externalId: data_get($attributes, 'external_id'),
            name: $attributes['name'],
            activeClipsCount: data_get($attributes, 'active_clips_count'),
        );
    }
}
