<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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

}
