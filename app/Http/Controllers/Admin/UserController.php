<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

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
			$user->surname = $request->surname;
			$user->phone_number = $request->phone_number;
			$user->email = $request->email;
            $user->password = Hash::make($request->password);
			$user->save();

			return redirect('admin/dashboard');
    }

    public function store(Request $request) {
        $token = Str::random(80);
        $admin = new User();
        $admin->name = $request->name;
        $admin->surname = $request->surname;
        $admin->email = $request->email;
        $admin->phone_number = $request->phone_number;
        $admin->auth_token = hash('sha256', $token);
        $admin->password = $request->password;
        $admin->save();
        return redirect('admin/dashboard');
    }
}

