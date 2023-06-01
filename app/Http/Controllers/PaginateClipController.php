<?php

namespace App\Http\Controllers;

use App\Repositories\PaginateClips;
use App\Repositories\Options\PaginationOption;
use App\Http\Requests\PaginateClipRequest;

class PaginateClipController extends Controller
{
    public function __construct(
        private PaginateClips $paginateClips,
    ) {}

    public function __invoke(PaginateClipRequest $request)
    {
        $clips = $this->paginateClips->handle(
            PaginationOption::from(
                attributes: $request->validated(),
            ),
        );

        return $clips;
    }
}
