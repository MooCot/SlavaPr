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
        if(!empty($event->usersid)) {
            foreach($event->usersid as $userid) {
                Notification::create($event->notification, $event->extraNotificationData, $userid);
            }
        }
        else {
            Notification::create($event->notification, $event->extraNotificationData, $event->userid);
        }
        foreach($event->tokens as $token) {
            $answer = $this->firebaseNotification($this->setAndroidConfig($token, $event->notification, $event->extraNotificationData));
            Log::info('firebase: '.$answer.' '.$token.' '.$event->notification);
            $answer = $this->firebaseNotification($this->setApnsConfig($token, $event->notification, $event->extraNotificationData)); 
            Log::info('firebase: '.$answer.' '.$token.' '.$event->notification);
        }
    }
}
