<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\PaginateAvailableClips;

class PaginateClipController extends Controller
{
    public function __invoke()
    {
        $clips = app(PaginateAvailableClips::class)->handle();
    }
}
