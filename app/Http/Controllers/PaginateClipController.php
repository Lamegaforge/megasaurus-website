<?php

namespace App\Http\Controllers;

use App\Repositories\PaginateAvailableClips;
use App\Http\Requests\PaginateClipRequest;
use App\ValueObjects\PaginateClips;

class PaginateClipController extends Controller
{
    public function __invoke(PaginateClipRequest $request)
    {
        $clips = app(PaginateAvailableClips::class)->handle(
            PaginateClips::fromRequest($request),
        );

        dd($clips);
    }
}
