<?php

namespace App\Http\Verifications;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Task;
use phpDocumentor\Reflection\Types\Boolean;

class TaskVerification
{
    public $task;
    private $user;

    public function __construct($user)
    {
        $this->user = $user;
    }

    public function findTaskById($task_id) {
        if(empty($task_id)) {
            return ['errors' => ['task_id' => [['code' => '1007', 'message' => 'Задача с указанным ID не найдена']]]];
        }
        $task = Task::where("id", $task_id)->first();
        return $task = !empty($task) ? $this->task = $task : $task = ['errors' => ['task_id' => [['code' => '1007', 'message' => 'Задача с указанным ID не найдена']]]];
    }

    public function findTaskByIdWithExecutorCreator($task_id) {
        if(empty($task_id)) {
            return ['errors' => ['task_id' => [['code' => '1007', 'message' => 'Задача с указанным ID не найдена']]]];
        }
        $task = DB::table('tasks')
                ->where('tasks.id', (int)$task_id)
                ->join('users as creator', 'creator.id', '=', 'tasks.creator_id')
                ->leftJoin('users as executor', 'executor.id', '=', 'tasks.executor_id')
                ->select('tasks.*', 'creator.name as creator_name', 'creator.surname as creator_surname',
                                    'executor.name as executor_name', 'executor.surname as executor_surname')    
                ->first(); 
        return $task = !empty($task) ? $this->task = $task : $task = ['errors' => ['task_id' => [['code' => '1007', 'message' => 'Задача с указанным ID не найдена']]]];
    }

    public function findTaskByIdWhereDateNull() {
        $task = Task::where("id", $this->task->id)->where('end_task', NULL)->first();
        return $task = !empty($task) ? $task : $task = ['errors' => ['accepted' => [['code' => '1016', 'message' => 'Задача уже завершена']]]];
    }

    public function findTaskWhereAccept() {
        $task = Task::where("id", $this->task->id)->where('accepted', 0)->first();
        return $task = !empty($task) ? $task : $task = ['errors' => ['accepted' => [['code' => '1014', 'message' => 'Задача уже принята']]]];
    }

    public function canFinishTask() {
        if(!empty($this->task)){
            $creator = $this->task->id == $this->task->creator_id ? true : false;
            $root = !empty(User::where('role_id', 1)->where('id', $this->user->id)) ? true : false;
            if($creator == true || $root == true) {
                return $this->task;
            }
        }

        return ['errors' => ['accepted' => [['code' => '1017', 'message' => 'Задача не может быть завершена данным пользователем']]]];
    }

    public function getFormatTask() {
        $task = $this->task;
        if(!empty($this->task->executor_surname))
        {
            $task->executor_name = $task->executor_name.' '.$task->executor_surname;
        }
        else {
            $task->executor_name = "Все";
        }
        $task->creator_name = $task->creator_name.' '.$task->creator_surname;
        $task->start_date = date("d.m.Y", strtotime($task->start_task));
        $task->start_time = date("H:i", strtotime($task->start_task));
        $task->deadline_date = date("d.m.Y", strtotime($task->must_end_task));
        $task->deadline_time = date("H:i", strtotime($task->must_end_task));
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
}
