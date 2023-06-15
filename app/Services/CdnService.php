<?php

namespace App\Services;

use App\ValueObjects\Game;
use App\ValueObjects\Clip;

class CdnService
{
    public function __construct(
        private string $baseCdn,
    ) {}

    public function thumbnail(Clip $clip): string
    {
        return 'https://ad-vitam.fra1.cdn.digitaloceanspaces.com/megasaurus-dev/cards/1244970157';
        return $this->baseCdn . '/thumbnails/' . $clip->uuid;
    }

    public function card(Game $game): string
    {
        return 'https://ad-vitam.fra1.cdn.digitaloceanspaces.com/megasaurus-dev/thumbnails/0195285d-c460-4c5f-9a46-7444a1e9611e';
        return $this->baseCdn . '/cards/' . $game->uuid;
    }
}
