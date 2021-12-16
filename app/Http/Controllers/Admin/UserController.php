<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index() {
        $users = User::get();
        return view('dashboard', [
            'users' => $users,
        ]);
    }

    public function edit(User $user) {
        return view('user.edit', [
            'user' => $user,
        ]);
    }

    public function create() {
        return view('user.create');
    }

    public function update(Request $request, User $user)
    {
			$user->name = $request->name;
			$user->email = $request->email;
            $user->password = Hash::make($request->password);
			$user->save();

			return redirect()->back()->withSuccess('Пользователь был успешно обновлен');
    }

    public function store(Request $request) {
        $admin = new User();
        $admin->name = $request->username;
        $admin->surname = $request->username;
        $admin->email = $request->email;
        $admin->password = $request->password;
        $admin->save();
        return view('dashboard');
    }
}

