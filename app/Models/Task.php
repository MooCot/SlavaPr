<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use PHPUnit\TextUI\XmlConfiguration\Group;

class Task extends Model
{
    use HasFactory;

    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'executor_id', 
        'creator_id'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'executor_id', 
        'creator_id'
    ];

    public function executor()
	{
		return $this->hasOne(Task::class, 'executor_id', 'executor_id');
	}

    public function creator()
	{
		return $this->hasOne(Task::class, 'creator_id', 'id');
	}

    // public static function getAllUnfinishedTasks() {
    //     $tasks = DB::table('tasks')
    //         ->where('end_task', NULL)
    //         ->whereDate('start_task', '>=',date('Y-m-d', strtotime(now())))
    //         ->whereDate('start_task', '<=',date('Y-m-d', strtotime("+6 days")))
    //         ->join('users as creator', 'creator.id', '=', 'tasks.creator_id')
    //         ->leftJoin('users as executor', 'executor.id', '=', 'tasks.executor_id')
    //         ->select('tasks.*', 'creator.name as creator_name', 'creator.surname as creator_surname',
    //                             'executor.name as executor_name', 'executor.surname as executor_surname')                
    //         ->get();
        
    //     if(!empty($tasks)) {
    //         return $tasks;
    //     }
    //     else {
    //         return '';
    //     }
    // }

    // public static function getUserUnfinishedTasks($user_id) {
    //     $tasks = DB::table('tasks')
    //         ->where('end_task', NULL)
    //         ->whereDate('start_task', '>=',date('Y-m-d', strtotime(now())))
    //         ->whereDate('start_task', '<=',date('Y-m-d', strtotime("+6 days")))
    //         ->where('executor_id', $user_id)
    //         ->join('users as creator', 'creator.id', '=', 'tasks.creator_id')
    //         ->leftJoin('users as executor', 'executor.id', '=', 'tasks.executor_id')
    //         ->select('tasks.*', 'creator.name as creator_name', 'creator.surname as creator_surname',
    //                             'executor.name as executor_name', 'executor.surname as executor_surname')                
    //         ->get();

    //     if(!empty($tasks)) {
    //         return $tasks;
    //     }
    //     else {
    //         return '';
    //     }
    // }

    public static function groupTasksByDate($user_role, $user_id) {
        $data = [];
        $daytask['date'] = date('d.m.Y', strtotime(now()));
        if($user_role == 1) {
            for($i=0; $i<=6; $i++) {
                $daytask['task'] = self::getAllUnfinishedTasks(date('Y-m-d', strtotime($daytask['date'])));
                array_push($data, $daytask);
                $daytask['date'] = date('d.m.Y', strtotime($daytask['date'].'+ 1 days'));
            }
        }
        else {
            for($i=0; $i<=6; $i++) {
                $daytask['task'] = self::getUserUnfinishedTasks(date('Y-m-d', strtotime($daytask['date'])), $user_id);
                array_push($data, $daytask);
                $daytask['date'] = date('d.m.Y', strtotime($daytask['date'].'+ 1 days'));
            }
        }

        return $data;
    }

    public static function getAllUnfinishedTasks($date) {
        $tasks = DB::table('tasks')
            ->where('end_task', NULL)
            ->whereDate('start_task', '=', $date)
            ->join('users as creator', 'creator.id', '=', 'tasks.creator_id')
            ->leftJoin('users as executor', 'executor.id', '=', 'tasks.executor_id')
            ->select('tasks.*', 'creator.name as creator_name', 'creator.surname as creator_surname',
                                'executor.name as executor_name', 'executor.surname as executor_surname')                
            ->get();
        
            if(!empty($tasks)) {
                foreach($tasks as $task) {
                    if(!empty($task->executor_surname))
                    {
                        $task->executor_name = $task->executor_name.' '.$task->executor_surname;
                    }
                    else {
                        $task->executor_name = "";
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
                }
    
                return $tasks;
                
            }
            else {
                return '';
            }
    }

    public static function getUserUnfinishedTasks($date, $user_id) {
        $tasks = DB::table('tasks')
            ->where('end_task', NULL)
            ->whereDate('start_task', '>=',date('Y-m-d', strtotime(now())))
            ->where('executor_id', $user_id)
            ->join('users as creator', 'creator.id', '=', 'tasks.creator_id')
            ->leftJoin('users as executor', 'executor.id', '=', 'tasks.executor_id')
            ->select('tasks.*', 'creator.name as creator_name', 'creator.surname as creator_surname',
                                'executor.name as executor_name', 'executor.surname as executor_surname')                
            ->get();

        if(!empty($tasks)) {
            foreach($tasks as $task) {
                if(!empty($task->executor_surname))
                {
                    $task->executor_name = $task->executor_name.' '.$task->executor_surname;
                }
                else {
                    $task->executor_name = "";
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
            }

            return $tasks;
            
        }
        else {
            return '';
        }
    }

}
