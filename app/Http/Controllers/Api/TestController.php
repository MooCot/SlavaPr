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
use Illuminate\Support\Facades\DB;

class TestController extends Controller
{
    use Firebase;

    public function index(Request $request) {

    }


}