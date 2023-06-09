<?php

namespace App\Repositories\Options;

use Domain\Enums\ClipStateEnum;

readonly final class PaginationOption
{
    public function __construct(
        public ?string $search,
        public ?string $gameId,
        public ?string $clipId,
        public ClipStateEnum $clipStateEnum,
        public ?string $sort,
    ) {}

    public static function from(array $attributes): self
    {
        return new self(
            search: data_get($attributes, 'search'),
            gameId: data_get($attributes, 'game_id'),
            clipId: data_get($attributes, 'clip_id'),
            clipStateEnum: ClipStateEnum::Ok,
            sort: data_get($attributes, 'sort'),
        );
    }
}
