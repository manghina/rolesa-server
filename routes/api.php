<?php

use Illuminate\Http\Request;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\UrgencyController;
use App\Http\Controllers\FormController;
use App\Http\Controllers\LogsController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\MailController;
use Illuminate\Support\Facades\Route;
use App\Http\API\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\PostController;

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('login', [AuthController::class, 'login']);
Route::post('register', [AuthController::class, 'register']);

Route::get('auth/{provider}', [AuthController::class, 'redirectToAuth']);
Route::get('auth/{provider}/callback', [AuthController::class, 'handleAuthCallback']);

Route::middleware('auth:api')->group(function () {
    Route::post('logout', [AuthController::class, 'logout']);
    Route::get('users', [UserController::class, 'all']);
    Route::get('user/{id}', [UserController::class, 'get']);
    Route::post('user', [UserController::class, 'update']);
    Route::get('settings/{user_id}', [SettingController::class, 'all']);
    Route::get('settingstest', [SettingController::class, 'test']);
    Route::prefix('posts')->group(function () {
        Route::put('/', [PostController::class, 'create']);
        Route::post('/', [PostController::class, 'update']);
        Route::post('/{id}/comment', [PostController::class, 'comment']);
        Route::get('/', [PostController::class, 'all']);
        Route::get('/my', [PostController::class, 'myposts']);
    });
});
