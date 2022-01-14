<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Task;
use App\Models\Notification;
use App\Models\FcmToken;
use App\Http\Requests\Api\LoginRequest;
use App\Events\TaskEvent;
use App\Traits\Firebase;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class TestController extends Controller
{
    use Firebase;

    public function index(Request $request) {
        // $token = $request->fcm_token;
        // $notification = [
        //     'title' =>'title',
        //     'body' => 'body of message.',
        //     'icon' =>'myIcon',
        //     'sound' => 'mySound'
        // ];
        // $extraNotificationData = ["message" => $notification,"moredata" =>'dd'];

        // $fcmNotification = [
        //     'to'        => $token, //single token
        //     'notification' => $notification,
        //     'data' => $extraNotificationData
        // ];
        // $ansver = $this->firebaseNotification($fcmNotification);
        // Log::info('firebase: '.$ansver);
        // return $ansver; 
        $task = Task::first();
        $tokens = FcmToken::returnAllFcmtokens();
        $users = User::returnAllUsersId();
        $user = User::first();
        $event = new TaskEvent();
        // $event->sendOne($task, $user, $tokens, 'Новая задача!', 'У вас новая задача: “'.$task->task_name.'”');
        $event->sendAll($task, $users, $tokens, 'Новая задача!', 'У вас новая задача: “'.$task->task_name.'”');
        if(!empty($event->usersid)) {
            foreach($event->usersid as $userid) {
                Notification::create($event->notification, $event->extraNotificationData, $userid);
            }
            // return "test";
        }
        else {
            Notification::create($event->notification, $event->extraNotificationData, $event->userid);
            // return "test2";
        }
        return $users;
    }
}