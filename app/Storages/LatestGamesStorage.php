<?php

namespace App\Storages;

use App\Repositories\LatestGames;
use App\Services\TtlFactory;
use Illuminate\Cache\CacheManager;
use Illuminate\Support\Collection;

class LatestGamesStorage
{
    public function __construct(
        private LatestGames $latestGames,
        private CacheManager $cache,
    ) {}

    public function get(): Collection
    {
        return $this->cache->remember('latest_games', TtlFactory::minutes(1), function () {
            return $this->latestGames->handle();
        });
    }
}
