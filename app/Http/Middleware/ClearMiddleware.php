<?php

namespace App\Http\Middleware;

use Closure;

class ClearMiddleware
{
    public function handle($request, Closure $next)
    {
        $userData = $request->get('phone_number');
        $userData = mb_eregi_replace("[^0-9+]", '', $userData);
        $request->merge([
            'phone_number' => $userData,
        ]);
        return $next($request);
    }
}