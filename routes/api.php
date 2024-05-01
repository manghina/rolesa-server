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
use App\Http\Controllers\SettingController;

//Route::get('sendhtmlemail','MailController@html_email');
Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('login', [AuthController::class, 'login']);
Route::post('register', [AuthController::class, 'register']);

Route::get('auth/{provider}', [AuthController::class, 'redirectToAuth']);
Route::get('auth/{provider}/callback', [AuthController::class, 'handleAuthCallback']);

Route::middleware('auth:api')->group(function () {
    Route::post('logout', [AuthController::class, 'logout']);
    Route::get('user', [AuthController::class, 'user']);
    Route::get('settings/{user_id}', [SettingController::class, 'all']);
});
