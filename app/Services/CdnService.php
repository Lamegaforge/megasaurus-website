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
        $parts = [
            '0195285d-c460-4c5f-9a46-7444a1e9611e',
            '061e9eda-11b4-4725-98f8-bfd865edd015',
            '0825aa75-6164-4dbe-9889-8341d713e9ee',
            '0e20eb0c-e4bd-4c20-ab7f-d9c5516af274',
            '13030597-018a-4c94-b4e9-fb627e2df38e',
            '165de95e-4a8a-4345-b547-bffcb634e836',
            '343c2430-c888-45b1-923d-08548e2a0ca7',
            '60cdcec5-ce1b-4f88-a640-237a2d34a444',
        ];

        shuffle($parts);

        return 'https://ad-vitam.fra1.cdn.digitaloceanspaces.com/megasaurus-dev/thumbnails/' . $parts[0];
        
        //return $this->baseCdn . '/thumbnails/' . $clip->uuid;
    }

    public function card(Game $game): string
    {
        return 'https://ad-vitam.fra1.cdn.digitaloceanspaces.com/megasaurus-dev/cards/1244970157';
        return $this->baseCdn . '/cards/' . $game->uuid;
    }
}
