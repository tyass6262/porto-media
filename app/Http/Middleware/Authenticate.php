<?php

namespace App\Http\Middleware;

use Closure;

class Authenticate
{
    public function handle($request, Closure $next)
    {
        if (!auth()->check()) {
            return redirect('/login');
        }

        return $next($request);
        protected function redirectTo($request)
{
    if (!$request->expectsJson()) {
        return route('login');
    }
}
    }
}