<?php

namespace App\Http\Controllers;

use App\Repositories\PaginateGamesRepository;
use App\Repositories\SearchGamesRepository;
use App\Http\Requests\PaginateGameRequest;
use App\Repositories\Options\PaginationOption;
use Illuminate\Support\Facades\View;

class PaginateGameController extends Controller
{
    public function __construct(
        private PaginateGamesRepository $paginateGamesRepository,
        private SearchGamesRepository $searchGamesRepository,
    ) {}

    public function __invoke(PaginateGameRequest $request)
    {
        /** 
         * Research with Algolia does not offer the same possibilities as a simple pagination
         */
        $games = $request->itsASearch()
            ? $this->searchGames($request)
            : $this->paginateGames($request);

        return View::make('games', [
            'games' => $games,
        ]);
    }

    private function searchGames(PaginateGameRequest $request)
    {
        return $this->searchGamesRepository->handle(
            search: $request->get('query'),
        );
    }

    private function paginateGames(PaginateGameRequest $request)
    {
        return $this->paginateGamesRepository->handle(
            PaginationOption::from(
                attributes: $request->validated(),
            ),
        );
    }
}
