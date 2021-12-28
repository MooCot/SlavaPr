<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Traits\Firebase;
use App\Events\TaskEvent;

class SendFirebaseNotification
{
    use Firebase;
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(TaskEvent $event)
    {
        // dd($event);
        $answer = [];
        // foreach($event->tokens as $token) {
        //     array_push($answer, $this->firebaseNotification($this->setAndroidConfig($token, 'test'))); 
        //     array_push($answer, $this->firebaseNotification($this->setApnsConfig($token, 'test'))); 
        // }
        // return $answer;
    }
}
