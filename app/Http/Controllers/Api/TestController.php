<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Notification;
use App\Models\FcmToken;
use App\Http\Requests\Api\TaskIdRequest;
use App\Http\Requests\Api\CreateTaskRequest;
use App\Models\Task;
use Illuminate\Support\Facades\DB;
use App\Traits\Firebase;

class TaskController extends Controller
{
    use Firebase;

    public function index(Request $request) {
        $token="";
        $notification = [
            'title' =>'title',
            'body' => 'body of message.',
            'icon' =>'myIcon',
            'sound' => 'mySound'
        ];
        $extraNotificationData = ["message" => $notification,"moredata" =>'dd'];

        $fcmNotification = [
            'to'        => $token, //single token
            'notification' => $notification,
            'data' => $extraNotificationData
        ];
        
        return $this->firebaseNotification($fcmNotification); 
    }
}