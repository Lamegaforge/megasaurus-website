<?php

namespace App\Actions;

use App\Models\Game;
use App\Repositories\PaginateClipsRepository;
use App\Repositories\Options\PaginationOption;
use Illuminate\Support\Collection;

class GameAndRandomClipsSample
{
    public function __construct(
        private PaginateClipsRepository $paginateClipsRepository,
    ) {}

    /**
     * Obtain a sample of clips from a specific game supplemented with random clips.
     */
    public function handle(Game $game): Collection
    {
        $randomGameClips = $this->getRandomGameClips($game);
        $randomClips = $this->getRandomClips();

        return collect($randomGameClips)
            ->merge($randomClips)
            ->shuffle();
    }

    private function getRandomGameClips(Game $game): array
    {
        $randomGameClips = $this->paginateClipsRepository->handle(
            PaginationOption::from([
                'game_uuid' => $game->uuid,
                'per_page' => 8,
                'random' => true,
                'simple_pagination' => true,
            ]),
        );

        return $randomGameClips->items();
    }

    private function getRandomClips(): array
    {
        $randomClips = $this->paginateClipsRepository->handle(
            PaginationOption::from([
                'per_page' => 4,
                'random' => true,
                'simple_pagination' => true,
            ]),
        );

        return $randomClips->items();
    }
}
