<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MailController;


Route::get('/', function () {
    return response()->json(['success' => 'false'], 401);
})->name('login');

Route::post('laravel_ten_test_mail', function () {
    $data = "We are learning Laravel 10 mail from laravelia.com";
});

Route::get('sendbasicemail', function () {
    $data = array('name'=>"Virat Gandhi");
   
    Mail::send(['text'=>'mail'], $data, function($message) {
       $message->to('manghina.dario@gmail.com', 'Tutorials Point')->subject
          ('Laravel Basic Testing Mail');
       $message->from('xyz@gmail.com','Virat Gandhi');
    });
    echo "Basic Email Sent. Check your inbox.";
})->name('login');

//Route::get('sendbasicemail','MailController@basic_email');
Route::get('sendhtmlemail','MailController@html_email');
Route::get('sendattachmentemail','MailController@attachment_email');