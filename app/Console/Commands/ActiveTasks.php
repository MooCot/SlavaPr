<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Events\TaskEvent;
use App\Models\Task;
use App\Models\User;

class ActiveTasks extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'task:active';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'find active task and call TaskEvent';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $findTasks = Task::where('must_end_task', '>', date("Y-m-d H:i", strtotime(now())))->count();
        if(!empty($findTasks)){
            foreach($findTasks as $task){
            if(!empty($task->executor_id)){
                $executor = User::where('id', $task->executor_id)->with('fcmTokens')->first();
                event(new TaskEvent($task, $executor, $executor['fcmTokens'], 'Задачи на сегодня!', 'Доброе утро! Ваши задачи на сегодня: 10 - Срочных, 2- заканчивается дедлайн, 5 - не срочных, 1- дедлайн просрочен'));
            }
          }
        }
        return Command::SUCCESS;
    }
}
