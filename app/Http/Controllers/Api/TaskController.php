<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Notification;
use App\Models\FcmToken;
use App\Http\Requests\Api\FcmTokenRequest;
use App\Models\Task;
use Illuminate\Support\Facades\DB;


class TaskController extends Controller
{
    public function getUnfinishedTasks(Request $request) {
    //  return $tasks = Task::where('end_task', NULL)->with('creator')->get();
    $tasks = DB::table('tasks')
            ->where('end_task', NULL)
            ->join('users as creator', 'creator.id', '=', 'tasks.creator_id')
            ->join('users as executor', 'executor.id', '=', 'tasks.executor_id')
            ->select('tasks.*', 'creator.name as creator_name', 'creator.surname as creator_surname',
                                'executor.name as executor_name', 'executor.surname as executor_surname')                
            ->get();
    foreach($tasks as $task) {
        $task->creator_name = $task->creator_name.' '.$task->creator_surname;
        $task->executor_name = $task->executor_name.' '.$task->executor_surname;
    }

    return [[
        "date" => now(),
        "task" => $tasks
    ]];
    }

    public function finishedTask(Request $request) {

        Task::where("id", $request->task_id)->update(['accepted' => 1, 'end_task'=>now()]);
        return "plugTrue";
    }

    public function createTask(Request $request) {
        $task = new Task;
        $task->task_name = $request->name;
        $task->deadline_expired = $request->deadline_date;
        $task->deadline_expired = $request->description;
        $task->executor_id = $request->executor_id;
        $task->priority = $request->priority;
        return "plugTrue";
    }

    public function getExecutorsTask(Request $request) {
        
    }

    public function getDetailsTask(Request $request) {
        $tasks = DB::table('tasks')
        ->where('tasks.id', $request->task_id)
        ->join('users as creator', 'creator.id', '=', 'tasks.creator_id')
        ->join('users as executor', 'executor.id', '=', 'tasks.executor_id')
        ->select('tasks.*', 'creator.name as creator_name', 'creator.surname as creator_surname',
                            'executor.name as executor_name', 'executor.surname as executor_surname')                
        ->get();
        $task = $tasks->toArray();
        return $task[0];
    }

    public function addTaskFinished(Request $request) {
        
    }
}