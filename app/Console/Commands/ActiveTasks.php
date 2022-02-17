<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Events\TaskEvent;
use App\Models\Task;
use App\Models\User;
use App\Models\FcmToken;

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
        $users = User::get();
        $event = new TaskEvent();
        $task = new Task();
        foreach($users as $user)
        {
            $tokens = User::returnFcmtokens($user->id);
            $endDeadlineTasks = Task::countEndDeadline($user->id);
            $notUrgentTasks = Task::countNotUrgentTask($user->id);
            $overdueDeadlineTasks = Task::countOverdueDeadline($user->id);
            $urgentTasks = Task::countUrgentTask($user->id);
            $event->sendOne($task, $user, $tokens, 'Задачи на сегодня!', 'Доброе утро! Ваши задачи на сегодня: '.$urgentTasks.' - Срочных, '.$endDeadlineTasks.' - заканчивается дедлайн, '.$notUrgentTasks.' - не срочных, '.$overdueDeadlineTasks.' - дедлайн просрочен');
            event($event);
        }
        return Command::SUCCESS;
    }
}
