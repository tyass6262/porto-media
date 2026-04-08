<?php

namespace App\Http\Middleware;

use Closure;

class AdminMiddleware
{
    public function handle($request, Closure $next)
    {
        if (!auth()->user() || !auth()->user()->isAdmin()) {
            abort(403);
        }

        return $next($request);
    }
}