<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index() {
        return view('dashboard');
    }

    public function edit() {
        return view('user.edit');
    }

    public function create() {
        return view('user.create');
    }
}

