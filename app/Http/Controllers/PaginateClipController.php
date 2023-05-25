<?php

namespace App\Http\Controllers;

use App\Repositories\PaginateAvailableClips;
use App\Repositories\Options\ClipPaginationOptions;
use App\Http\Requests\PaginateClipRequest;

class PaginateClipController extends Controller
{
    public function __invoke(PaginateClipRequest $request)
    {
        $clips = app(PaginateAvailableClips::class)->handle(
            ClipPaginationOptions::fromRequest($request),
        );

        return $clips;
    }
}
