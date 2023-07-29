<?php

namespace App\Services\Space;

use App\Models\Game;

class CardService
{
    public function __construct(
        private string $baseCdn,
        private string $envFolder,
    ) {}

    public function get(Game $game): string
    {
        return $this->baseCdn . '/' . $this->envFolder . '/cards/' . $game->uuid;
    }
}