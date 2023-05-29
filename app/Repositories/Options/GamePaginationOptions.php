<?php

namespace App\Repositories\Options;

use App\Http\Requests\PaginateGameRequest;

readonly final class GamePaginationOptions
{
    public function __construct(
        public ?string $search,
        public string $sort,
    ) {}

    public static function fromRequest(PaginateGameRequest $request): self
    {
        return new self(
            search: $request->get('search'),
            sort: $request->get('sort', 'created_at'),
        );
    }
}
