<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\CardController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\BillingController;
use App\Http\Controllers\MailController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;


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

Route::get('/', function () {
    return response()->json(['success' => 'false'], 401);
})->name('login');

//Route::post('login', [AuthController::class, 'login']);
//Route::post('register', [RegisterController::class, 'register']);
//Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])->middleware('auth');

/*Route::get('autocomplete', [CustomerController::class, 'autocomplete'])->middleware('auth');
Route::post('customers', [CustomerController::class, 'getAll'])->middleware('auth');
Route::post('pdf', [CustomerController::class, 'pdf'])->middleware('auth');
Route::post('excel', [CustomerController::class, 'excel']);
Route::get('getCustomer/{id}', [CustomerController::class, 'getCustomer'])->middleware('auth');
Route::post('updateCustomer/{id}', [CustomerController::class, 'updateCustomer'])->middleware('auth');   
Route::post('saveCustomerInfo', [CustomerController::class, 'saveCustomerInfo'])->middleware('auth');     
Route::get('fetch', [CustomerController::class, 'fetch'])->middleware('auth');    
Route::post('deleteCustomer/{id}', [CustomerController::class, 'deleteCustomer'])->middleware('auth');  */ // Use the api instead

Route::post('laravel_ten_test_mail', function () {
    $data = "We are learning Laravel 10 mail from laravelia.com";
});
