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
use App\Http\Verifications\TaskVerification;

class TaskController extends Controller
{
    public function getUnfinishedTasks(Request $request) {
        $user = $request->user();
        $data = Task::groupTasksByDate($user->role_id, $user->id);
        return $data;
    }

    public function finishedTask(Request $request) {
        $user = $request->user();
        $taskVerification = new TaskVerification($user);
        $error = $taskVerification->findTaskById($request->task_id);
        if(gettype($error)!='object') {
            return $error;
        }
        $error = $taskVerification->findTaskByIdWhereDateNull($request->task_id);
        if(gettype($error)!='object') {
            return $error;
        }
        $error = $taskVerification->canFinishTask($request->task_id);
        if(gettype($error)!='object') {
            return $error;
        }
        $task = $taskVerification->task;
        $task->end_task = (string)date('Y-m-d H:i:s', strtotime(now()));
        $task->save();
        $tokens = User::returnFcmtokens($task->creator_id);
        event(new TaskEvent($task, $user, $tokens, 'Задача завершена!', 'Задача “'.$task->task_name.'” завершена. Исполнитель: “'.$user->name.' '.$user->surname.'”'));
        return "plugTrue";
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
        $task->deadline_expired = 0;
        $task->priority = $request->priority;
        $task->save(); 
        if(!empty($request->executor_id)) {
            $tokens = User::returnFcmtokens($task->executor_id);
            event(new TaskEvent($task, $user, $tokens, 'Новая задача!', 'У вас новая задача: “'.$task->task_name.'”'));
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
    }

    public function getDetailsTask(Request $request) {
        $user = $request->user();
        $taskVerification = new TaskVerification($user);
        $error = $taskVerification->findTaskByIdWithExecutorCreator($request->task_id);
        if(!gettype($error)=='object') {
            return $error;
        }
        return $taskVerification->getFormatTask();
    }

    public function addTaskAccepted(Request $request) {
        $user = $request->user();
        $taskVerification = new TaskVerification($user);
        $error = $taskVerification->findTaskById($request->task_id);
        if(gettype($error)!='object') {
            return $error;
        }
        $error = $taskVerification->findTaskWhereAccept();
        if(gettype($error)!='object') {
            return $error;
        }
        $error = $taskVerification->canFinishTask();
        if(gettype($error)!='object') {
            return $error;
        }
        $task = $taskVerification->task;
        $task->accepted = 1;
        $task->save();
        $tokens = User::returnFcmtokens($task->creator_id);
        event(new TaskEvent($task, $user, $tokens, 'Задача принята!', 'Задача “'.$task->task_name.'” принята в работу исполнителем: “'.$user->name.' '.$user->surname.'”'));
        return "plugTrue";
    }
}