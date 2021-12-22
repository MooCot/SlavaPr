<?php


namespace App\Traits;

use Illuminate\Support\Facades\Http;

trait Firebase
{

    public function firebaseNotification($fcmNotification){

        $fcmUrl = config('firebase.fcm_url');

        $apiKey = config('firebase.fcm_api_key');

        $http = Http::withToken($apiKey)->withHeaders([
            'Content-Type'=>'application/json'
        ])->post($fcmUrl, $fcmNotification);

        return $http;
    }

    public function setAndroidConfig(string $token, string $notification)
    {
        $extraNotificationData = ["message" => $notification,"moredata" =>'dd'];
        $fcmNotification = [
            'to'        => $token,
            'notification' => $notification,
            'data' => $extraNotificationData
        ];
        return $fcmNotification;
    }
    
    public function setApnsConfig(string $token, string $notification)
    {
        $fcmNotification = [
            'to'        => $token,
            'notification' => $notification,
            'data' => [
                'payload' => [
                    'aps' => [
                        'alert' => [
                            'title' => '$GOOG up 1.43% on the day',
                            'body' => '$GOOG gained 11.80 points to close at 835.67, up 1.43% on the day.',
                        ],
                        'badge' => 42,
                        'sound' => 'default',
                    ],
                ],
            ],
        ];
        return $fcmNotification;
    }
}