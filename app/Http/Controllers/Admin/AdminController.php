<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\Admin\AdminUser\AdminStoreRequest;

class AdminController extends Controller
{

    public $active = 'admin';

    public function index() {
        $admins = Admin::get();
        return view('admin.index', [
            'admins' => $admins,
            'active' => $this->active
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

    public function store(AdminStoreRequest $request) {
        $admin = new Admin();
        $admin->name = $request->name;
        $admin->surname = $request->surname;
        $admin->email = $request->email;
        $admin->password = Hash::make($request->password);
        $admin->save();
        return redirect('admin/admin');
    }

    public function update(AdminStoreRequest $request, Admin $admin)
    {
        $admin->name = $request->name;
        $admin->surname = $request->surname;
        $admin->email = $request->email;
        if($request->password!=='111111')
        {
            $admin->password = Hash::make($request->password);
        }
        $admin->save();
        return redirect('admin/admin');
    }

    public function show(Admin $admin)
    {
        $admins = Admin::get();
        return view('admin.index', [
            'admins' => $admins,
            'admindelete' => $admin,
        ]);
    }

    public function destroy(Request $request, Admin $admin)
    {
        $admin->delete();
        return redirect('admin/admin');
    }
    
}

