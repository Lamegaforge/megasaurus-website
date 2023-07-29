<?php

namespace App\Http\Controllers;

use App\Repositories\PaginateGamesRepository;
use App\Http\Requests\PaginateGameRequest;
use App\Repositories\Options\PaginationOption;

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

        return $games;
    }
}
