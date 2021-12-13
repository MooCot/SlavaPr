<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Closure;
use Illuminate\Http\Request;

class LoginApi
{
    public function handle(Request $request, Closure $next)
    {

        $basicData = $this->getType($request);
        if($basicData['typeAuth']==='Basic')
        {
            $dataAuth = $this->getBasicData($basicData['token']);
            $user = User::where('email', $dataAuth[0])
                            ->orWhere('password', $dataAuth[1])
                            ->first();
            if (!empty($user)) {
                Auth::login($user);
                return $next($request);
            }
            return response()->json([
                "success" => false,
                "code" => 1001,
                "message" => "Пользователь с таким номером телефона не зарегистрирован"
            ], 403);
        }
        
        return response()->json([
            "success" => false,
            "code" => 1002,
            "message" => "Неправильный пароль"
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