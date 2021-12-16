<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Notification;
use App\Models\FcmToken;
use App\Http\Requests\Api\FcmTokenRequest;
use Illuminate\Support\Facades\DB;


class NotificationController extends Controller
{
    public function index(Request $request) {
        $user = $request->user();
        $notifications = Notification::where('user_id', $user->id)->get();
        foreach($notifications as $notification) {
            $notification->start_date = date("d.m.Y", strtotime($notification->created_at));
            $notification->start_time = date("H:i", strtotime($notification->created_at));
            unset($notification->created_at);
        }
        return $notifications;
    }

    public function markAsRead(Request $request) {
        $user = $request->user();
        Notification::where('user_id', $user->id)->update(['marked_as_read' => 1]);
        return "plugTrue";
    }

    public function regToken(FcmTokenRequest $request) {
        $user = $request->user();
        $tokens = FcmToken::where('fcm_token', $request->fcm_token)->where('user_id', $user->id)->first();
        if(empty($tokens)) {
            $fcmToken = new FcmToken;
            $fcmToken->fcm_token = $request->fcm_token;
            $fcmToken->user_id = $user->id;
            $fcmToken->save();
        }
        $tokens = FcmToken::where('fcm_token', $request->fcm_token)->get();
        foreach($tokens->toArray() as $token) {
            if($token['user_id'] !== $user->id) {
                FcmToken::where('user_id', $token['user_id'])->delete();
            }
        }
        return "plugTrue";
    }

    public function delToken(FcmTokenRequest $request) {
        $user = $request->user();
        FcmToken::where('user_id', $user->id)->where('fcm_token', $request->fcm_token)->delete();
        return "plugTrue";
    }
}