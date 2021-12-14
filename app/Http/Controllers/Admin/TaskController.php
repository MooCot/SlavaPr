<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Task;

class TaskController extends Controller
{

    public function index() {
        $tasks = Task::get();
        return view('task.index', [
            'tasks' => $tasks,
        ]);
    }
    
}

