<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Task;
use Illuminate\Support\Facades\DB;

class TaskController extends Controller
{
    public $active = 'task';

    public function index() {
        $tasks = DB::table('tasks')
            ->where('end_task','<>', NULL)
            ->join('users as creator', 'creator.id', '=', 'tasks.creator_id')
            ->leftJoin('users as executor', 'executor.id', '=', 'tasks.executor_id')
            ->select('tasks.*', 'creator.name as creator_name', 'creator.surname as creator_surname',
                                'executor.name as executor_name', 'executor.surname as executor_surname')              
            ->orderBy('end_task', 'asc')               
            ->paginate(20);
        foreach($tasks as $task)
        {
            $task->must_end_task_date = date("d.m.y", strtotime($task->must_end_task));
            $task->must_end_task_time = date("H:i", strtotime($task->must_end_task));
            $task->start_task_date = date("d.m.y", strtotime($task->start_task));
            $task->start_task_time = date("H:i", strtotime($task->start_task));
            if(!empty($task->end_task)) {
                $task->end_task_date = date("d.m.y", strtotime($task->end_task));
                $task->end_task_time = date("H:i", strtotime($task->end_task));
            }
            else{
                $task->end_task_date = null;
                $task->end_task_time = null;
            }


        }
        return view('task.index', [
            'tasks' => $tasks,
            'active' => $this->active
        ]);
    }
}

