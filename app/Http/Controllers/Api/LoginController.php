<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\AppId;
use App\Http\Requests\Api\LoginRequest;

class LoginController extends Controller
{
    public function index(Request $request) {
        return $request->user();
    }

    public function updateUserData(LoginRequest $request) {
        $user = $request->user();
        $user->name = $request->name;
        $user->surname = $request->surname;
        $user->email = $request->email;
        $user->save();
        return $user;
    }
}