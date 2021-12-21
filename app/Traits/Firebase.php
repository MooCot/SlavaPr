<?php


namespace App\Traits;

use Illuminate\Support\Facades\Http;

trait Firebase
{

    public  function firebaseNotification2($fcmNotification, $header){

        $fcmUrl = config('firebase.fcm_url');

        $apiKey = config('firebase.fcm_api_key');

        $http=Http::withHeaders([
            $header,
            'Authorization:key'=>$apiKey,
            'Content-Type'=>'application/json'
        ])->post($fcmUrl, $fcmNotification);

        return $http->json();
    }

    public function firebaseNotification($fcmNotification){

        $fcmUrl =config('firebase.fcm_url');

        $apiKey=config('firebase.fcm_api_key');

        $http=Http::withHeaders([
            'Authorization:key'=>$apiKey,
            'Content-Type'=>'application/json'
        ])  ->post($fcmUrl,$fcmNotification);

        return  $http->json();
    }

    public function setAndroidConfig(array $data)
    {
        $android = [
            'priority' => 'normal',
            'data' => $data,
        ];
        return $android;
    }
    
    public function setApnsConfig(string $title, string $notification, int $badge, array $data)
    {
        $apns_data['headers'] = [
            'apns-priority' => '10',
        ];
        $apns_data['payload'] = [
            'aps' => [
                'alert' => [
                    'title' => $title,
                    'body' => $notification,
                ],
                'badge' => $badge,
                'mutable-content' => 1,
            ],
        ];
        $apns_data['payload'] = array_merge($apns_data['payload'], $data);
        return $apns_data;
    }
}