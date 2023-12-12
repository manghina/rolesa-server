<?php

use Illuminate\Http\Request;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\UrgencyController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\MailController;
use Illuminate\Support\Facades\Route;
use App\Http\API\Controllers\AuthController;

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

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('login', [AuthController::class, 'login']);
Route::post('register', [AuthController::class, 'register']);

Route::middleware('auth:api')->group(function () {
    Route::post('logout', [AuthController::class, 'logout']);
    Route::get('user', [AuthController::class, 'user']);
    Route::get('customer/all', [CustomerController::class, 'getAll']);
    Route::post('customer/create', [CustomerController::class, 'update']);
    Route::post('customer/update', [CustomerController::class, 'update']);
    Route::get('customer/{id}', [CustomerController::class, 'get']);
    Route::delete('customer/{id}', [CustomerController::class, 'delete']);
    Route::get('category/all', [CategoryController::class, 'getAll']);
    Route::get('urgency/all', [UrgencyController::class, 'getAll']);
});
