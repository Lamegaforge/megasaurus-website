<?php

namespace App\ValueObjects;

readonly final class Clip
{
    public function __construct(
        public string $id,
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
            id: $attributes['id'],
            externalId: data_get($attributes, 'external_id'),
            title: $attributes['title'],
            url: data_get($attributes, 'url'),
            views: data_get($attributes, 'views'),
            duration: data_get($attributes, 'duration'),
            author: Author::from([
                'name' => data_get($attributes, 'author_name'),
            ]),
            game: Game::from([
                'id' => $attributes['id'],
                'external_id' => data_get($attributes, 'game_external_id'),
                'name' => data_get($attributes, 'game_name'),
            ]),
        );
    }
}
