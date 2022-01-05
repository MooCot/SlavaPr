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
        // $token = 'fOSgQyNVQFKYgmFWsj64m7:APA91bFxMz69_ohuEXFCzTRMYR-d8DQAcn3tkpzi3ueOKytXAKuPzoUcUYAXV0DeSaTWw-F8jjWNhYpQJRc6KvFRMXKIBzrMKHz6RcwCF3b6RFFthOcuTvJXXMc5epjC05-bsYY-3Zf9';
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
        
        // return $this->firebaseNotification($fcmNotification); 
        return config('firebase.fcm_url');
    }
}