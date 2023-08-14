<?php

namespace App\Storages;

use App\Services\TtlFactory;
use Illuminate\Cache\CacheManager;
use App\Repositories\Options\PaginationOption;
use App\Repositories\PaginateGamesRepository;

class LatestGamesStorage
{
    public function __construct(
        private PaginateGamesRepository $paginateGamesRepository,
        private CacheManager $cache,
    ) {}

    public function get(): array
    {
        return $this->cache->remember('latest_games', TtlFactory::minutes(60), function () {

            $games = $this->paginateGamesRepository->handle(
                PaginationOption::from([
                    'sort' => 'games.created_at',
                    'per_page' => 12,
                ]),
            );

            return $games->items();
        });
    }
}
