<?php

namespace App\Storages;

use App\Repositories\Options\PaginationOption;
use App\Repositories\PaginateClipsRepository;
use App\Services\TtlFactory;
use Illuminate\Cache\CacheManager;

class LatestAvailableClipsStorage
{
    public function __construct(
        private PaginateClipsRepository $paginateClipsRepository,
        private CacheManager $cache,
    ) {}

    public function get(): array
    {
        return $this->cache->remember('latest_available_clips', TtlFactory::minutes(1), function () {

            $clips = $this->paginateClipsRepository->handle(
                PaginationOption::from([
                    'sort' => 'published_at',
                    'per_page' => 20,
                ]),
            );

            return $clips->items();
        });
    }
}
