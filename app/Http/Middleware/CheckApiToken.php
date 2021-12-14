<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\ApiToken;
use Closure;
use Illuminate\Http\Request;

class CheckApiToken
{
    public function handle(Request $request, Closure $next)
    {
        $token = $request->header('X-API-Key');
        $user = ApiToken::where('api_token', $token)->first();
        if(empty($user)) {
            return response()->json([
                "success" => false,
                "code" => 1019,
                "message" => "Недействительный ключ API"
            ], 403);
        }
        else {
            return $next($request);
        }
    }
}