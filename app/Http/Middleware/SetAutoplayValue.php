<?php

namespace App\Http\Middleware;

use App\Enums\AutoplayEnum;
use Closure;
use Illuminate\Http\Request;
use App\Storages\AutoplayStorage;
use Symfony\Component\HttpFoundation\Response;

class SetAutoplayValue
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        app(AutoplayStorage::class)->set(
            (bool) $request->cookie(AutoplayEnum::Cookie->value),
        );

        return $next($request);
    }
}
