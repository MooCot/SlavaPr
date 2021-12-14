<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\LoginController;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Api\NotificationController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['middleware' => ['check.api.token', 'login.api', 'ansver']], function () {
    Route::get('user', [LoginController::class, 'index']);
    Route::put('user', [LoginController::class, 'updateUserData']);
    Route::prefix('user')->group(function () {
        Route::get('notifications-history', [NotificationController::class, 'index']);
        Route::post('notifications-history/mark-as-read', [NotificationController::class, 'markAsRead']);
        Route::post('register-fcm-token', [NotificationController::class, 'regToken']);
        Route::post('remove-fcm-token', [NotificationController::class, 'delToken']);
    });
});