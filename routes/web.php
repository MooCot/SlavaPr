<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () { return view('site.welcome'); });
Route::get('admin', function () { return redirect('admin/login'); });

Route::prefix('/')->group(function () {
    Route::get('login', [SiteLogin::class, 'login'])->name('admin.form');
    Route::post('login', [SiteLogin::class, 'authenticate'])->name('admin.login');

    Route::group(['middleware' => 'auth:admin'], function () {
        Route::get('dashboard', function () {
            return view('admin.dashboard');
        });
    });
});