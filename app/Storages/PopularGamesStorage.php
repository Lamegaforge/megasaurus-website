<?php

namespace App\Storages;

use App\Repositories\PopularGames;
use App\Services\TtlFactory;
use Illuminate\Cache\CacheManager;
use Illuminate\Support\Collection;

class PopularGamesStorage
{
    public function __construct(
        private PopularGames $popularGames,
        private CacheManager $cache,
    ) {}

    public function get(): Collection
    {
        return $this->cache->remember('popular_games', TtlFactory::minutes(1), function () {
            return $this->popularGames->handle();
        });
    }
}
