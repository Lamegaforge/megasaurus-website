<?php

namespace App\Http\Controllers;

use App\Repositories\PaginateGamesRepository;
use App\Http\Requests\PaginateGameRequest;
use App\Repositories\Options\PaginationOption;
use Illuminate\Support\Facades\View;

class PaginateGameController extends Controller
{
    public function __construct(
        private PaginateGamesRepository $paginateGamesRepository,
    ) {}

    public function __invoke(PaginateGameRequest $request)
    {
        $games = $this->paginateGamesRepository->handle(
            PaginationOption::from(
                attributes: $request->validated(),
            ),
        );

        // dd($games);

        return View::make('show-game', [
            'games' => $games,
        ]);
    }
}
