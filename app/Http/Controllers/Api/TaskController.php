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
            ->where('accepted', 0)
            ->join('users as creator', 'creator.id', '=', 'tasks.creator_id')
            ->leftJoin('users as executor', 'executor.id', '=', 'tasks.executor_id')
            ->select('tasks.*', 'creator.name as creator_name', 'creator.surname as creator_surname',
                                'executor.name as executor_name', 'executor.surname as executor_surname')                
            ->get();
    foreach($tasks as $task) {
        if(!empty($task->executor_surname))
        {
            $task->executor_name = $task->executor_name.' '.$task->executor_surname;
        }
        else {
            $task->executor_name = "";
        }
        $task->creator_name = $task->creator_name.' '.$task->creator_surname;
        $task->start_date = date("d.m.Y", strtotime($task->start_task));
        $task->start_time = date("H:i", strtotime($task->start_task));
        $task->deadline_date = date("d.m.Y", strtotime($task->must_end_task));
        $task->deadline_time = date("H:i", strtotime($task->must_end_task));
        unset($task->executor_surname);
        unset($task->creator_surname);
        unset($task->executor_id);
        unset($task->creator_id);
        unset($task->start_task);
        unset($task->end_task);
        unset($task->must_end_task);
    }
    return [[
        "date" => date('Y-m-d H:i:s', strtotime(now())),
        "task" => $tasks
    ]];
    }

    public function finishedTask(Request $request) {

        // Task::where("id", $request->task_id)->update(['end_task'=>now()]);
        // return "plugTrue";
        $user = $request->user();
        if(!empty($request->task_id))
        {
            $task = Task::where("id", $request->task_id)->where('end_task', NULL)->first();
            if(!empty($task)) {
                if($task->creator_id == $user->id)
                {
                    $task->end_task = date('Y-m-d H:i:s', strtotime(now()));
                    $task->save();
                    return "plugTrue";
                }
                else {
                    return ['errors' => ['accepted' => [['code' => '1017', 'message' => 'Задача не может быть завершена данным пользователем']]]];
                }
            }
            else {
                return ['errors' => ['accepted' => [['code' => '1016', 'message' => 'Задача уже завершена']]]];
            }
        }
        else {
            return ['errors' => ['task_id' => [['code' => '1007', 'message' => 'Задача с указанным ID не найдена']]]];
        }
    }

    public function createTask(CreateTaskRequest $request) {
        $user = $request->user();
        $task = new Task;
        $task->task_name = $request->name;
        $deadline_date = strtotime($request->deadline_date);
        $task->must_end_task = date('Y-m-d H:i:s', $deadline_date);
        $task->start_task = now();
        $task->task_description = $request->description;
        $task->executor_id = $request->executor_id;
        $task->creator_id = $user->id;
        $task->accepted = 0;
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
        $task = DB::table('tasks')
            ->where('tasks.id', $request->task_id)
            ->join('users as creator', 'creator.id', '=', 'tasks.creator_id')
            ->join('users as executor', 'executor.id', '=', 'tasks.executor_id')
            ->select('tasks.*', 'creator.name as creator_name', 'creator.surname as creator_surname',
                                'executor.name as executor_name', 'executor.surname as executor_surname')    
            ->first(); 

            if(!empty($task->executor_surname))
            {
                $task->executor_name = $task->executor_name.' '.$task->executor_surname;
            }
            else {
                $task->executor_name = "";
            }
            $task->creator_name = $task->creator_name.' '.$task->creator_surname;
            $task->start_date = date("d.m.Y", strtotime($task->start_task));
            $task->start_time = date("H:i", strtotime($task->start_task));
            $task->deadline_date = date("d.m.Y", strtotime($task->must_end_task));
            $task->deadline_time = date("H:i", strtotime($task->must_end_task));
            unset($task->executor_surname);
            unset($task->creator_surname);
            unset($task->executor_id);
            unset($task->creator_id);
            unset($task->start_task);
            unset($task->end_task);
            unset($task->must_end_task);   

        return $task;
    }

    public function addTaskAccepted(Request $request) {
        $user = $request->user();
        if(!empty($request->task_id))
        {
            // Task::where("id", $request->task_id)->update(['accepted' => 1]);
            $task = Task::where("id", $request->task_id)->where('accepted', 0)->first();
            if(!empty($task)) {
                if($task->creator_id == $user->id)
                {
                    $task->accepted = 1;
                    $task->save();
                    return "plugTrue";
                }
                else {
                    return ['errors' => ['accepted' => [['code' => '1015', 'message' => 'Задача не может быть принята данным пользователем']]]];
                }
            }
            else {
                return ['errors' => ['accepted' => [['code' => '1014', 'message' => 'Задача уже принята']]]];
            }
        }
        else {
            return ['errors' => ['task_id' => [['code' => '1007', 'message' => 'Задача с указанным ID не найдена']]]];
        }
    }
}