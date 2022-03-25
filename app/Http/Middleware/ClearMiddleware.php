<?php

namespace App\Http\Middleware;

use Closure;

class ClearMiddleware
{
    public function handle($request, Closure $next)
    {
        return $next($request);
    }
}