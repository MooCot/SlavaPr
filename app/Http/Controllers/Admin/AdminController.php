<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{

    public function index() {
        return view('admin.index');
    }

    public function edit() {
        return view('admin.edit');
    }

    public function create() {
        return view('admin.create');
    }
    
}

