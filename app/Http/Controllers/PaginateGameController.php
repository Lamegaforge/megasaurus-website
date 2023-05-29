<?php

namespace App\Http\Controllers;

use App\Repositories\PaginateAvailableGames;
use App\Http\Requests\PaginateGameRequest;
use App\Repositories\Options\GamePaginationOptions;

class PaginateGameController extends Controller
{
    public function __invoke(PaginateGameRequest $request)
    {
        $games = app(PaginateAvailableGames::class)->handle(
            GamePaginationOptions::fromRequest($request),
        );

        return $games;
    }
}
