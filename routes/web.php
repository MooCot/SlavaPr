<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\LoginController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () { return view('login'); });
Route::get('admin', function () { return redirect('admin/login'); });

Route::prefix('admin')->group(function () {
    Route::get('login', [LoginController::class, 'login'])->name('admin.form');
    Route::post('login', [LoginController::class, 'authenticate'])->name('admin.login');

    Route::group(['middleware' => 'auth:web'], function () {
        Route::get('dashboard', function () {
            return view('dashboard');
        });
    });
});