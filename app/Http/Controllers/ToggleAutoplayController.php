<?php

namespace App\Http\Controllers;

use App\Enums\AutoplayEnum;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

class ToggleAutoplayController extends Controller
{
    public function __invoke(Request $request)
    {
        $identifier = AutoplayEnum::Cookie;

        $autoplay = (bool) $request->cookie($identifier->value);

        $cookie = Cookie::forever($identifier->value, (string) ! $autoplay);

        return redirect()
            ->back()
            ->withCookie($cookie);
    }
}
