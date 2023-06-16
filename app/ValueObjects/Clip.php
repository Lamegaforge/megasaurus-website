<?php

namespace App\ValueObjects;

use App\Services\CdnService;

readonly final class Clip
{
    public function __construct(
        public string $uuid,
        public ?string $externalId,
        public string $title,
        public ?string $url,
        public ?string $views,
        public ?string $duration,
        public Author $author,
        public Game $game,
    ) {}

    public static function from($attributes): self
    {
        return new self(
            uuid: $attributes['uuid'],
            externalId: data_get($attributes, 'external_id'),
            title: $attributes['title'],
            url: data_get($attributes, 'url'),
            views: data_get($attributes, 'views'),
            duration: data_get($attributes, 'duration'),
            author: Author::from([
                'uuid' => data_get($attributes, 'author_uuid'),
                'name' => data_get($attributes, 'author_name'),
            ]),
            game: Game::from([
                'uuid' => data_get($attributes, 'game_uuid'),
                'name' => data_get($attributes, 'game_name'),
            ]),
        );
    }

    public function thumbnail(): string
    {
        return app(CdnService::class)->thumbnail(
            uuid: $this->uuid,
        );
    }
}
