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
        return $this->baseCdn . '/thumbnails/' . $clip->externalId;
    }

    public function card(Game $game): string
    {
        return $this->baseCdn . '/cards/' . $game->externalId;
    }
}
