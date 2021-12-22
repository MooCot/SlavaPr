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
    protected $signature = 'command:name';

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
        $findTasks = Task::where('must_end_task', '>', date("Y-m-d H:i", strtotime(now())))->get();
        foreach($findTasks as $task){
            $user = User::where('id', $task->executor_id)->with('fcmTokens')->first();
            event(new TaskEvent($task, $user['fcmTokens'], 'test'));
        }
        return Command::SUCCESS;
    }
}
