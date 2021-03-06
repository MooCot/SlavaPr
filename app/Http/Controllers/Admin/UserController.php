<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Role;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Http\Requests\Admin\UserStoreRequest;

class UserController extends Controller
{
    public $active = 'user';

    public function index() {
        $users = User::with('role')->paginate(20);
        return view('dashboard', [
            'users' => $users,
            'active' => $this->active
        ]);
    }

    public function edit(User $user) {
        $roles = Role::get();
        return view('user.edit', [
            'user' => $user,
            'roles' => $roles,
        ]);
    }

    public function create() {
        $roles = Role::get();
        return view('user.create', [
            'roles' => $roles,
        ]);
    }

    public function update(UserStoreRequest $request, User $user)
    {
        $user->name = $request->name;
        $user->surname = $request->surname;
        $user->email = $request->email;
        $user->access = $request->access;
        $user->role_id = $request->role;
        if($request->password!=='******')
        {
            $user->password = Hash::make($request->password);
        }
        if($user->phone_number!==mb_eregi_replace("[^0-9+]", '', $request->phone_number))
        {
            $user->phone_number = mb_eregi_replace("[^0-9+]", '', $request->phone_number);
        }
        if($user->email!==$request->email)
        {
            $user->email = $request->email;
        }
        $user->save();

        return redirect('admin/dashboard');
    }

    public function store(UserStoreRequest $request) {
        $token = Str::random(80);
        $user = new User();
        $user->name = $request->name;
        $user->surname = $request->surname;
        $user->email = $request->email;
        $user->phone_number = mb_eregi_replace("[^0-9+]", '', $request->phone_number);
        $user->auth_token = hash('sha256', $token);
        $user->access = $request->access;
        $user->password = Hash::make($request->password);
        $user->role_id = $request->role;
        $user->save();
        return redirect('admin/dashboard');
    }

    public function destroy(Request $request, User $user)
    {
        $user->delete();
        return redirect('admin/dashboard');
    }
}

