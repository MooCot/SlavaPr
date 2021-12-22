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
use App\Events\TaskEvent;

class TestController extends Controller
{
    use Firebase;

    // public function index(Request $request) {
    //     $token="cvIQqlnEQTWCMRRuX87pj2:APA91bEgDLX6gCUU3weWJe6DsQxzCWCNJdk07TD3ctGcpAOnxQTUtJctjWVubjctfT2qHajdHLJBVYjjGg-NqA89YuEZny-SdESTWqx7KVams21K3imoeCCHRY5I3Py2-jI4kuFTKsgb";
    //     $notification = [
    //         'title' =>'title',
    //         'body' => 'body of message.',
    //     ];
    //     $extraNotificationData = ["message" => $notification,"moredata" =>'dd'];

    //     $fcmNotification = [
    //         'to'        => $token, //single token
    //         'notification' => $notification,
    //         'data' => $extraNotificationData
    //     ];
        
    //     return $this->firebaseNotification($fcmNotification); 
    // }

    public function index(Request $request) {
        $answer = [];
        $token = "cvIQqlnEQTWCMRRuX87pj2:APA91bEgDLX6gCUU3weWJe6DsQxzCWCNJdk07TD3ctGcpAOnxQTUtJctjWVubjctfT2qHajdHLJBVYjjGg-NqA89YuEZny-SdESTWqx7KVams21K3imoeCCHRY5I3Py2-jI4kuFTKsgb";
        array_push($answer, $this->firebaseNotification($this->setAndroidConfig($token, 'test'))); 
        array_push($answer, $this->firebaseNotification($this->setApnsConfig($token, 'test'))); 
        return $answer;
    }

    public function testEvent(Request $request) {
        $task = Task::first();
        $token = ["cvIQqlnEQTWCMRRuX87pj2:APA91bEgDLX6gCUU3weWJe6DsQxzCWCNJdk07TD3ctGcpAOnxQTUtJctjWVubjctfT2qHajdHLJBVYjjGg-NqA89YuEZny-SdESTWqx7KVams21K3imoeCCHRY5I3Py2-jI4kuFTKsgb"];
        event(new TaskEvent($task, $token, 'test'));
    }
}