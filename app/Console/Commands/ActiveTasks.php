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
        $findTasks = Task::where('end_task', NULL)->get();
        foreach($findTasks as $task){
            $user = User::where('id', $task->executor_id)->with('fcmTokens')->first();
            event(new TaskEvent($task, $user['fcmTokens'], 'test'));
        }
        return Command::SUCCESS;
    }
}
