<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MessageController;

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

Route::group(['prefix' => 'auth'], function () {
    Route::post('register', [AuthController::class, 'register']);
    Route::post('login', [AuthController::class, 'login'])->name('login');
    Route::post('logout', [AuthController::class, 'logout']);
    Route::post('delete', [AuthController::class, 'delete']);
    Route::get('userList',[AuthController::class, 'getUserList']);
    Route::get('unauthorized', [AuthController::class, 'unauthorized'])->name('auth.unauthorized');
});

Route::group(['prefix' => 'message'], function () {
    Route::get('/', [MessageController::class, 'getOwnChat']);
    Route::get('all', [MessageController::class, "getAllChat"]);
    Route::post('send', [MessageController::class, 'send']);
});
