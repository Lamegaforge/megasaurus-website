<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;
use App\ValueObjects\Clip;
use Domain\Enums\ClipStateEnum;

class FindDisplayableClip
{
    /** 
     * @throws \Symfony\Component\HttpKernel\Exception\NotFoundHttpException
     */
    public function handle(string $uuid): Clip
    {
        $clip = DB::table('clips')
            ->select(
                'clips.id',
                'clips.uuid',
                'clips.url',
                'clips.title',
                'clips.views',
                'clips.duration',
                'clips.published_at',
                'games.name as game_name',
                'games.id as game_id',
                'games.uuid as game_uuid',
                'authors.id as author_id',
                'authors.uuid as author_uuid',
                'authors.name as author_name',
            )
            ->join('games', 'clips.game_id', '=', 'games.id')
            ->join('authors', 'clips.author_id', '=', 'authors.id')
            ->where('clips.uuid', $uuid)
            ->where('state', ClipStateEnum::Ok)
            ->first();

        abort_if(is_null($clip), 404);

        return Clip::from((array) $clip);
    }
}
