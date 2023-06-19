<?php

namespace App\Http\Controllers;

use Domain\Enums\ClipStateEnum;
use Illuminate\Support\Facades\DB;

class ShowRandomClipController extends Controller
{
    public function __invoke()
    {
        $clip = DB::table('clips')
            ->where('state', ClipStateEnum::Ok)
            ->inRandomOrder()
            ->first();

        return to_route('clips.show', $clip->uuid);
    }
}
