<?php

namespace App\Repositories\Options;

use Domain\Enums\ClipStateEnum;

readonly final class PaginationOption
{
    public function __construct(
        public ?string $search,
        public ?string $gameUuid,
        public ?string $clipUuid,
        public ClipStateEnum $clipStateEnum,
        public ?string $sort,
    ) {}

    public static function from(array $attributes): self
    {
        return new self(
            search: data_get($attributes, 'search'),
            gameUuid: data_get($attributes, 'game_uuid'),
            clipUuid: data_get($attributes, 'clip_uuid'),
            clipStateEnum: ClipStateEnum::Ok,
            sort: data_get($attributes, 'sort'),
        );
    }
}
