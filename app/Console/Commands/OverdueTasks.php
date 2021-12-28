<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Events\TaskEvent;
use App\Models\Task;
use App\Models\User;

class OverdueTasks extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'task:overdue';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
        $findTasks = Task::where('end_task', NULL)->get();
        foreach($findTasks as $task){
            $executor = User::where('id', $task->executor_id)->with('fcmTokens')->first();
            $creator = User::where('id', $task->creator_id)->with('fcmTokens')->first();
            event(new TaskEvent($task, $creator['fcmTokens'], 'Задача: “'.$task->task_name.'” просрочена исполнителем: “'.$executor->name.' '.$executor->surname.'”'));
        }
        return Command::SUCCESS;
    }
}
