<?php

namespace App\Repositories\Options;

use App\Http\Requests\PaginateGameRequest;
use Domain\Enums\ClipStateEnum;

readonly final class GamePaginationOptions
{
    public function __construct(
        public ?string $search,
        public ?string $externalId,
        public ClipStateEnum $clipStateEnum,
        public string $sort,
    ) {}

    public static function from(array $attributes): self
    {
        return new self(
            search: $attributes['search'] ?? null,
            externalId: $attributes['external_id'] ?? null,
            clipStateEnum: ClipStateEnum::Ok,
            sort: $attributes['sort'] ?? 'created_at',
        );
    }

    public static function fromRequest(PaginateGameRequest $request): self
    {
        return new self(
            search: $request->get('search'),
            externalId: null,
            clipStateEnum: ClipStateEnum::Ok,
            sort: $request->get('sort', 'created_at'),
        );
    }
}
