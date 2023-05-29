<?php

namespace App\Repositories\Options;

use App\Http\Requests\PaginateClipRequest;
use Domain\Enums\ClipStateEnum;

readonly final class ClipPaginationOptions
{
    public const defaultSorting = 'clips.published_at';

    public function __construct(
        public ?string $search,
        public ?string $externalGameId,
        public ClipStateEnum $clipStateEnum,
        public string $sort,
    ) {}

    public static function from(array $attributes): self
    {
        return new self(
            search: data_get($attributes, 'search'),
            externalGameId: data_get($attributes, 'external_game_id'),
            clipStateEnum: ClipStateEnum::Ok,
            sort: data_get($attributes, 'sort'),
        );
    }
}
