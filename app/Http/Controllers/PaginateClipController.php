<?php

namespace App\Http\Controllers;

use App\Repositories\PaginateClips;
use App\Repositories\Options\PaginationOption;
use App\Http\Requests\PaginateClipRequest;

use Illuminate\Support\Facades\View;

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

        return View::make('clips', [
            'clips' => $clips,
        ]);
    }
}
