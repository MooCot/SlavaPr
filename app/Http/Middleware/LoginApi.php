<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Closure;
use Illuminate\Http\Request;

class LoginApi
{
    // refaq
    public function handle(Request $request, Closure $next)
    {
        $basicData = $this->getType($request);
        if($basicData['typeAuth']==='Bearer'){
            $user = User::where('auth_token', $request->bearerToken())->first();
            if (!empty($user)) {
                Auth::login($user);
                return $next($request);
            }
            else {
                return response()->json([
                    "success" => false,
                    "code" => 1003,
                    "message" => "Недействительный токен пользователя"
                ], 403);
            }
        }

        else if($basicData['typeAuth']==='Basic')
        {
            $dataAuth = $this->getBasicData($basicData['token']);
            $user = User::where('phone_number', $dataAuth[0])
                            ->first();
            if (!empty($user)) {
               if(Hash::check($dataAuth[1], $user->password)) {
                    Auth::login($user);
                    return $next($request);
               }
               else {
                return response()->json([
                    "success" => false,
                    "code" => 1002,
                    "message" => "Неправильный пароль"
                ], 403);
               }
            }
            return response()->json([
                "success" => false,
                "code" => 1001,
                "message" => "Пользователь с таким номером телефона не зарегистрирован"
            ], 403);
        }
        
        return response()->json([
            "success" => false,
            "code" => 1003,
            "message" => "Недействительный токен пользователя"
        ], 403);
    }

    private function getBasicData($token)
    {
        $dataToken = base64_decode($token);
        return $dataAuth = explode(":", $dataToken);
    }

    private function getType(Request $request){
        $authorization = $request->header('Authorization');
        $token = strstr($authorization, ' ');
        $typeAuth = substr($authorization, 0, -strlen($token));
        return $clearToken = [
            'typeAuth' => $typeAuth,
            'token' => $token,
        ];
    }
}