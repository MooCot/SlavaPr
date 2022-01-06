<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Traits\Firebase;
use App\Events\TaskEvent;
use App\Models\Notification;
use Illuminate\Support\Facades\Log;

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
        $answers = [];
        Notification::create($event->notification, $event->extraNotificationData, 1);
        foreach($event->tokens as $token) {
            $ansver = $this->firebaseNotification($this->setAndroidConfig($token, $event->notification, $event->extraNotificationData));
            // array_push($answer, )); 
            Log::info('firebase: '.$ansver);
            // array_push($answer, $this->firebaseNotification($this->setApnsConfig($token, $event->notification, $event->extraNotificationData))); 
        }
        // return $answers;
    }
}
