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

class TestController extends Controller
{
    use Firebase;

    public function index(Request $request) {
        $token = $request->fcm_token;
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