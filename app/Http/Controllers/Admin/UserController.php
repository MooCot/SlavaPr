<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
}

