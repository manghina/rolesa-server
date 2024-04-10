<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MailController;


Route::get('/', function () {
    return response()->json(['success' => 'false'], 401);
})->name('login');

Route::post('laravel_ten_test_mail', function () {
    $data = "We are learning Laravel 10 mail from laravelia.com";
});

Route::get('sendhtmlemail','MailController@html_email');
Route::get('sendattachmentemail','MailController@attachment_email');
