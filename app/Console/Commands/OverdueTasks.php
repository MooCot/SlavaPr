<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Events\TaskEvent;
use App\Models\Task;
use App\Models\User;
use App\Models\FcmToken;

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
        $findTasks = Task::where('end_task', NULL)->whereDate('must_end_task', '<', date('Y-m-d H:i', strtotime(now())))->get();
        if(!empty($findTasks)){
            foreach($findTasks as $task){
                $executor = User::where('id', $task->executor_id)->with('fcmTokens')->first();
                $creator = User::where('id', $task->creator_id)->with('fcmTokens')->first();
                if(!empty($task->executor_id)) {
                    $tokens = User::returnFcmtokens($creator->id);
                    $event = new TaskEvent();
                    $event->sendOne($task, $creator, $tokens, 'Задача просрочена!', 'Задача: “'.$task->task_name.'” просрочена исполнителем: “'.$executor->name.' '.$executor->surname.'”');
                    event($event);
                }
                else {
                    $tokens = FcmToken::returnAllFcmtokens();
                    $users = User::returnAllUsersId();
                    $event = new TaskEvent();
                    $event->sendAll($task, $users, $tokens, 'Задача просрочена!', 'Задача: “'.$task->task_name.'” просрочена исполнителем: Все“');
                    event($event);
                }
                $task->must_end_task = date('Y-m-d H:i', strtotime(now().'+ 1 days'));
                $task->save();
            }
        }
        
        return Command::SUCCESS;
    }
}
