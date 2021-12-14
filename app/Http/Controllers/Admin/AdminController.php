<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Admin;

class AdminController extends Controller
{

    public function index() {
        $admins = Admin::get();
        return view('admin.index', [
            'admins' => $admins,
        ]);
    }

    public function edit(Admin $admin) {
        return view('admin.edit', [
            'admin' => $admin,
        ]);
    }

    public function create() {
        return view('admin.create');
    }

    public function store(Request $request) {
        $admin = new Admin();
        $admin->name = $request->username;
        $admin->surname = $request->username;
        $admin->email = $request->email;
        $admin->password = $request->password;
        $admin->save();
        return view('admin.index');
    }

    public function destroy(Admin $admin)
    {
        $admin->delete();
    }
    
}

