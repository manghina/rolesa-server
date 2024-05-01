<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;

Route::get('/', function () {
    return response()->json(['success' => 'false'], 401);
})->name('login');


 Route::get('test',[CategoryController::class, 'send']);
// Route::get('sendattachmentemail','MailController@attachment_email');
