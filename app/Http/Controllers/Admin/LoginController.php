<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Events\TaskEvent;
use App\Models\Task;

class LoginController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    
    public function login()
    {
        return view('login');
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('/admin/dashboard');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
    
        $request->session()->regenerateToken();
    
        return redirect('/');
    }

    public function notification(Request $request)
    {
        $user = User::where('phone_number', $request->phone)->first();
        $task = Task::first();
        $event = new TaskEvent();
        $tokens = User::returnFcmtokens($user->id);
        $event->sendOne($task, $user, $tokens, 'Тестовый пуш!', 'body');
        event($event);
        return redirect('/admin/dashboard');
    }
    public function show(Request $request)
    {
        return view('test');
    }

    protected function guard()
    {
        return Auth::guard('web');
    }
}

