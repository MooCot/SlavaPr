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
            $data=[];
            $data2=[];
            foreach($myResponse['errors'] as $key=>$val)
            {
                array_push($data, $val);
            }
            foreach($data as $val)
            {
                array_push($data2, $val[0]);
            }
            $myResponse = ['success'=>false, 'data'=>$data2];
            return response()->json($myResponse);
        }
        elseif($myResponse==='plugTrue')
        {
            $user = $request->user();
            $myResponse = ['success'=>true];
            return response()->json($myResponse)->header('X-Auth-Token', $user->api_token);
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
            return response()->json($myResponse)->header('X-Auth-Token', $user->auth_token);
        }
        return response()->json($myResponse);
    }
}
