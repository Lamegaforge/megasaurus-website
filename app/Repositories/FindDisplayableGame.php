<?php

namespace App\Repositories;

use App\Dtos\Hook;
use Illuminate\Support\Facades\DB;
use App\ValueObjects\Game;
use Domain\Enums\ClipStateEnum;

class FindDisplayableGame
{
    /** 
     * @throws \Symfony\Component\HttpKernel\Exception\NotFoundHttpException
     */
    public function handle(hook $hook): Game
    {
        $game = DB::table('games')
            ->select(
                'games.id',
                'games.uuid',
                'games.name',
                DB::raw('COUNT(clips.id) as active_clips_count'),
            )
            ->leftJoin('clips', function ($join) {
                $join->on('games.id', '=', 'clips.game_id')
                    ->where('clips.state', ClipStateEnum::Ok);
            })
            ->where('state', ClipStateEnum::Ok)
            ->where('games.uuid', $hook)
            ->orWhere('games.external_id', $hook)
            ->havingRaw('active_clips_count > 0')
            ->first();

        abort_unless($game, 404);

        return Game::from((array) $game);
    }
}
