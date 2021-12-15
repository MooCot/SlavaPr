<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Notification;
use App\Models\FcmToken;
use App\Http\Requests\Api\TaskIdRequest;
use App\Http\Requests\Api\CreateTaskRequest;
use App\Models\Task;
use Illuminate\Support\Facades\DB;


class TaskController extends Controller
{
    public function getUnfinishedTasks(Request $request) {
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

        Task::where("id", $request->task_id)->update(['end_task'=>now()]);
        return "plugTrue";
    }

    public function createTask(CreateTaskRequest $request) {
        $task = new Task;
        $task->task_name = $request->name;
        $deadline_date = strtotime($request->deadline_date);
        $task->must_end_task = date('Y-m-d H:i:s',$deadline_date);
        $task->task_description = $request->description;
        $task->executor_id = $request->executor_id;
        $task->priority = $request->priority;
        $task->save(); 
        return "plugTrue";
    }

    public function getExecutorsTask(Request $request) {
        $tasks = DB::table('tasks')
            ->rightJoin('users as executor', 'executor.id', '=', 'tasks.executor_id')
            ->select('executor.id','executor.name as executor_name', 'executor.surname as executor_surname')    
            ->get();  
        return $tasks;   
    }

    public function getDetailsTask(Request $request) {
        $tasks = DB::table('tasks')
            ->where('tasks.id', $request->task_id)
            ->join('users as creator', 'creator.id', '=', 'tasks.creator_id')
            ->join('users as executor', 'executor.id', '=', 'tasks.executor_id')
            ->select('tasks.*', 'creator.name as creator_name', 'creator.surname as creator_surname',
                                'executor.name as executor_name', 'executor.surname as executor_surname')    
            ->first();                                
        return $tasks;
    }

    public function addTaskAccepted(Request $request) {
        Task::where("id", $request->task_id)->update(['accepted' => 1]);
        return "plugTrue";
    }
}