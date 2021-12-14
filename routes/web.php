<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\TaskController;

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

Route::get('login', [LoginController::class, 'login'])->name('form');
Route::post('login', [LoginController::class, 'authenticate'])->name('admin.login');

Route::prefix('admin')->group(function () {
    Route::group(['middleware' => 'auth:web'], function () {

        Route::get('dashboard', [UserController::class, 'index'])->name('home');
        Route::get('user/edit', [UserController::class, 'edit'])->name('user.edit');
        Route::get('user/create', [UserController::class, 'edit'])->name('user.create');

        Route::get('task', [TaskController::class, 'index'])->name('tasks');

        Route::get('admin', [AdminController::class, 'index'])->name('admins');
        Route::get('admin/edit', [AdminController::class, 'edit'])->name('admin.edit');
        Route::get('admin/create', [AdminController::class, 'edit'])->name('admin.create');

        Route::get('logout', [LoginController::class, 'logout'])->name('admin.logout');
    });
});