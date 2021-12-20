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

Route::get('login', [LoginController::class, 'login'])->name('login');
Route::post('login', [LoginController::class, 'authenticate'])->name('login');

Route::prefix('admin')->group(function () {
    Route::group(['middleware' => 'auth:web'], function () {

        Route::get('dashboard', [UserController::class, 'index'])->name('home');
        Route::get('user/edit/{user}', [UserController::class, 'edit'])->name('user.edit');
        Route::put('user/edit/{user}', [UserController::class, 'update'])->name('user.update');
        Route::get('user/create', [UserController::class, 'create'])->name('user.create');
        Route::post('user/create', [UserController::class, 'store'])->name('user.store');

        Route::get('task', [TaskController::class, 'index'])->name('tasks');

        Route::get('admin', [AdminController::class, 'index'])->name('admins');
        Route::get('admin/edit/{admin}', [AdminController::class, 'edit'])->name('admin.edit');
        Route::put('admin/edit/{admin}', [AdminController::class, 'update'])->name('admin.update');
        Route::get('admin/create', [AdminController::class, 'create'])->name('admin.create');
        Route::post('admin/create', [AdminController::class, 'store'])->name('admin.store');
        Route::delete('admin/destroy{admin}', [AdminController::class, 'destroy'])->name('admin.destroy');

        Route::get('logout', [LoginController::class, 'logout'])->name('admin.logout');
    });
});