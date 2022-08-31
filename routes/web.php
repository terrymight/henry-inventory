<?php

use Illuminate\Support\Facades\Route;

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
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::get('users', [App\Http\Controllers\UserController::class,'index'])->middleware(['auth']);

Route::get('/customers/list', [App\Http\Controllers\CustomersController::class,'index'])->middleware(['auth']);

Route::get('/customer/create', [App\Http\Controllers\CustomersController::class,'create'])->middleware(['auth']);


Route::get('sms-settings', [App\Http\Controllers\SmsController::class,'index'])->middleware(['auth']);

Route::get('state/list', [App\Http\Controllers\StateController::class,'index'])->middleware(['auth']);

Route::get('state/create', [App\Http\Controllers\StateController::class,'create'])->middleware(['auth']);

Route::post('state/store', [App\Http\Controllers\StateController::class,'store'])->middleware(['auth'])->name('state/store');


require __DIR__.'/auth.php';
