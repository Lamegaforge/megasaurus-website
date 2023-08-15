<?php

namespace App\Storages;

use App\Repositories\PopularGamesRepository;
use App\Services\TtlFactory;
use Illuminate\Cache\CacheManager;
use Illuminate\Support\Collection;

class PopularGamesStorage
{
    public function __construct(
        private PopularGamesRepository $popularGamesRepository,
        private CacheManager $cache,
    ) {}

    public function get(): Collection
    {
        return $this->cache->remember('popular_games', TtlFactory::days(1), function () {
            return $this->popularGamesRepository->handle();
        });
    }
}
