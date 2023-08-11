<?php

namespace App\Http\Controllers;

use App\Repositories\PaginateClipsRepository;
use Illuminate\Routing\Redirector;
use App\Repositories\Options\PaginationOption;

class ShowRandomClipController extends Controller
{
    public function __construct(
        private PaginateClipsRepository $paginateClipsRepository,
        private Redirector $redirector,
    ) {}

    public function __invoke()
    {
        $paginator = $this->paginateClipsRepository->handle(
            PaginationOption::from([
                'random' => true,
                'per_page' => 1,
                'simple_pagination' => true,
            ]),
        );

        $clips = $paginator->items();

        return $this->redirector->route(
            'clips.show',
            $clips[0]->uuid,
        );
    }
}
