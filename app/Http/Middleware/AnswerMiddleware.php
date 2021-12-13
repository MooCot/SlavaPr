<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AnswerMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        $response = $next($request);
        $myResponse = $response->original;
        
        if(!empty($myResponse['errors']))
        {
            $myResponse = ['success'=>false, 'errors'=>$myResponse];
            return response()->json($myResponse);
        }
        elseif($myResponse==='plugTrue')
        {
            $user = $request->user();
            $myResponse = ['success'=>true];
            return response()->json($myResponse)->header('X-API-Key', $user->api_token);
        }
        elseif($myResponse==='plugFalse')
        {
            $myResponse = ['success'=>false];
            return response()->json($myResponse);
        }
        else
        {
            $user = $request->user();
            $myResponse = ['success'=>true,'data'=>$myResponse];
            return response()->json($myResponse)->header('X-API-Key', $user->api_token);
        }
        return response()->json($myResponse);
    }
}
