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

    public function destroy(Admin $admin)
    {
        $admin->delete();
    }
    
}

