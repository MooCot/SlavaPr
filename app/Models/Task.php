<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

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

    public static function getAllUnfinishedTasks() {
        $tasks = DB::table('tasks')
            ->where('end_task', NULL)
            ->join('users as creator', 'creator.id', '=', 'tasks.creator_id')
            ->leftJoin('users as executor', 'executor.id', '=', 'tasks.executor_id')
            ->select('tasks.*', 'creator.name as creator_name', 'creator.surname as creator_surname',
                                'executor.name as executor_name', 'executor.surname as executor_surname')                
            ->get();
        
        if(!empty($tasks)) {
            return $tasks;
        }
        else {
            return '';
        }
    }

    public static function getUserUnfinishedTasks($user_id) {
        $tasks = DB::table('tasks')
            ->where('end_task', NULL)
            ->where('executor_id', $user_id)
            ->join('users as creator', 'creator.id', '=', 'tasks.creator_id')
            ->leftJoin('users as executor', 'executor.id', '=', 'tasks.executor_id')
            ->select('tasks.*', 'creator.name as creator_name', 'creator.surname as creator_surname',
                                'executor.name as executor_name', 'executor.surname as executor_surname')                
            ->get();

        if(!empty($tasks)) {
            return $tasks;
        }
        else {
            return '';
        }
    }

}
