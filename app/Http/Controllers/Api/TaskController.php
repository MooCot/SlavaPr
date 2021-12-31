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
use App\Models\User;
use Illuminate\Support\Facades\DB;
use App\Events\TaskEvent;
use phpDocumentor\Reflection\Types\Boolean;

class TaskController extends Controller
{
    public function getUnfinishedTasks(Request $request) {
        $user = $request->user();
        $data = Task::groupTasksByDate($user->role_id, $user->id);
        return $data;
    }

    public function finishedTask(Request $request) {
        $user = $request->user();
        if(!empty($request->task_id)) {
            $task = Task::where("id", $request->task_id)->first();
            if(!empty($task)) {
                $task = Task::where("id", $request->task_id)->where('end_task', NULL)->first();
                if(!empty($task)) {
                    if($task->creator_id == $user->id)
                    {
                        $task->end_task = (string)date('Y-m-d H:i:s', strtotime(now()));
                        $task->save();
                        $user = User::where('id', $task->creator_id)->with('fcmTokens')->first();
                        $arr = [];
                        foreach($user->fcmTokens as $token) {
                            array_push($arr, $token->fcm_token);
                        }
                        event(new TaskEvent($task, $user, $arr, 'Задача завершена!', 'Задача “'.$task->task_name.'” завершена. Исполнитель: “'.$user->name.' '.$user->surname.'”'));
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
        else {
            return ['errors' => ['task_id' => [['code' => '1007', 'message' => 'Задача с указанным ID не найдена']]]];
        }
    }

    public function createTask(CreateTaskRequest $request) {
        
        $user = $request->user();
        $task = new Task;
        $task->task_name = $request->name;
        $deadline_date = (string)strtotime($request->deadline_date);
        $task->must_end_task = (string)date('Y-m-d H:i:s', $deadline_date);
        $task->start_task = now();
        $task->task_description = $request->description;
        $task->executor_id = $request->executor_id;
        $task->creator_id = $user->id;
        $task->accepted = 0;
        $task->deadline_expired = 0;
        $task->priority = $request->priority;
        $task->save(); 
        if(!empty($request->executor_id)) {
            $arr = [];
            foreach($user->fcmTokens as $token) {
               array_push($arr, $token->fcm_token);
            }
            event(new TaskEvent($task, $user, $arr, 'Новая задача!!', 'У вас новая задача: “'.$task->task_name.'”'));
        }
        return "plugTrue";
    }

    public function getExecutorsTask(Request $request) {
        $users = DB::table('users')
        ->select('id', 'name', 'surname')                
        ->get();
        if(!empty($users)) {
            foreach($users as $user) {
                $user->name = $user->name.' '.$user->surname;
                unset($user->surname);
            }
            return $users;
        }
        else {
            return '';
        }
        return $users;   
    }

    public function getDetailsTask(Request $request) {
        if(!empty($request->task_id)) {
            
            $task = DB::table('tasks')
                ->where('tasks.id', (int)$request->task_id)
                ->join('users as creator', 'creator.id', '=', 'tasks.creator_id')
                ->leftJoin('users as executor', 'executor.id', '=', 'tasks.executor_id')
                ->select('tasks.*', 'creator.name as creator_name', 'creator.surname as creator_surname',
                                    'executor.name as executor_name', 'executor.surname as executor_surname')    
                ->first(); 
            if(!empty($task)) {
                if(!empty($task->executor_surname))
                {
                    $task->executor_name = $task->executor_name.' '.$task->executor_surname;
                }
                else {
                    $task->executor_name = "Все";
                }
                $task->creator_name = $task->creator_name.' '.$task->creator_surname;
                $task->start_date = (string)date("d.m.Y", strtotime($task->start_task));
                $task->start_time = (string)date("H:i", strtotime($task->start_task));
                $task->deadline_date = (string)date("d.m.Y", strtotime($task->must_end_task));
                $task->deadline_time = (string)date("H:i", strtotime($task->must_end_task));
                $task->accepted = (boolean)$task->accepted;
                $task->deadline_expired = (boolean)$task->deadline_expired;
                unset($task->executor_surname);
                unset($task->creator_surname);
                unset($task->executor_id);
                unset($task->creator_id);
                unset($task->start_task);
                unset($task->end_task);
                unset($task->must_end_task);   

                 return $task;
            }
            else {
                return ['errors' => ['task_id' => [['code' => '1007', 'message' => 'Задача с указанным ID не найдена']]]];
            }
        }
        else {
            return ['errors' => ['task_id' => [['code' => '1007', 'message' => 'Задача с указанным ID не найдена']]]];
        }
    }

    public function addTaskAccepted(Request $request) {
        $user = $request->user();
        if(!empty($request->task_id))
        {
            $task = Task::where("id", $request->task_id)->first();
            if(!empty($task)){
                $task = Task::where("id", $request->task_id)->where('accepted', 0)->first();
                if(!empty($task)) {
                    if($task->creator_id == $user->id)
                    {
                        $task->accepted = 1;
                        $task->save();
                        $user = User::where('id', $task->creator_id)->with('fcmTokens')->first();
                        $arr = [];
                        foreach($user->fcmTokens as $token) {
                            array_push($arr, $token->fcm_token);
                        }
                        event(new TaskEvent($task, $user, $arr, 'Задача принята!', 'Задача “'.$task->task_name.'” принята в работу исполнителем: “'.$user->name.' '.$user->surname.'”'));
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
        else {
            return ['errors' => ['task_id' => [['code' => '1007', 'message' => 'Задача с указанным ID не найдена']]]];
        }
    }
}