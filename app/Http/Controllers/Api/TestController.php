<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Task;
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

        $findTasks = Task::where('end_task', NULL)->whereDate('must_end_task', '<', date('Y-m-d H:i', strtotime(now())))->get();
        return $findTasks;
    }
}