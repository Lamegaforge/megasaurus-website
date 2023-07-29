<?php

namespace App\Http\Controllers;

use App\Repositories\PaginateClipsRepository;
use App\Repositories\SearchClipsRepository;
use App\Repositories\Options\PaginationOption;
use App\Http\Requests\PaginateClipRequest;

use Illuminate\Support\Facades\View;

class PaginateClipController extends Controller
{
    public function __construct(
        private PaginateClipsRepository $paginateClipsRepository,
        private SearchClipsRepository $searchClipsRepository,
    ) {}

    public function __invoke(PaginateClipRequest $request)
    {
        /** 
         * Research with Algolia does not offer the same possibilities as a simple pagination
         */
        $clips = $request->itsASearch()
            ? $this->searchClips($request)
            : $this->paginateClips($request);

        return View::make('clips', [
            'clips' => $clips,
        ]);
    }

    private function searchClips(PaginateClipRequest $request)
    {
        return $this->searchClipsRepository->handle(
            search: $request->get('query'),
        );
    }

    private function paginateClips(PaginateClipRequest $request)
    {
        return $this->paginateClipsRepository->handle(
            PaginationOption::from(
                attributes: $request->validated(),
            ),
        );
    }
}
