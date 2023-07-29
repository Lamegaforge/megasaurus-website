<?php

namespace App\Http\Controllers;

use App\Enums\AutoplayEnum;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Routing\Redirector;

class ToggleAutoplayController extends Controller
{
    public function __construct(
        private Redirector $redirector,
    ) {}

    public function __invoke(Request $request)
    {
        $identifier = AutoplayEnum::Cookie;

        $autoplay = (bool) $request->cookie($identifier->value);

        $cookie = Cookie::forever($identifier->value, (string) ! $autoplay);

        return $this->redirector->back()->withCookie($cookie);
    }
}
