<?php

namespace App\Http\Controllers;

use App\Repositories\PaginateGames;
use App\Http\Requests\PaginateGameRequest;
use App\Repositories\Options\PaginationOption;

class PaginateGameController extends Controller
{
    public function __construct(
        private PaginateGames $paginateGames,
    ) {}

    public function __invoke(PaginateGameRequest $request)
    {
        $games = $this->paginateGames->handle(
            PaginationOption::from(
                attributes: $request->validated(),
            ),
        );

        return $games;
    }
}
