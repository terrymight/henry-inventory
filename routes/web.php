<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

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

Route::get('/customers/list', [App\Http\Controllers\CustomersController::class,'index'])->middleware(['auth'])->name('customers.list');
Route::get('/customer/create', [App\Http\Controllers\CustomersController::class,'create'])->middleware(['auth']);
Route::get('customer/{id}/edit', [App\Http\Controllers\CustomersController::class,'edit'])->middleware(['auth']);
Route::put('customer/{id}', [App\Http\Controllers\CustomersController::class,'update'])->middleware(['auth']);
Route::post('customer/store', [App\Http\Controllers\CustomersController::class,'store'])->middleware(['auth'])->name('customer/store');
Route::delete('customer/destroy/{id}', [App\Http\Controllers\CustomersController::class,'destroy'])->middleware(['auth'])->name('customer.destroy');

Route::get('state/list', [App\Http\Controllers\StateController::class,'index'])->middleware(['auth']);
Route::get('state/create', [App\Http\Controllers\StateController::class,'create'])->middleware(['auth']);
Route::get('state/{id}/edit', [App\Http\Controllers\StateController::class,'edit'])->middleware(['auth']);
Route::put('state/{id}', [App\Http\Controllers\StateController::class,'update'])->middleware(['auth']);
Route::delete('state/destroy/{id}', [App\Http\Controllers\StateController::class,'destroy'])->middleware(['auth'])->name('state.destroy');
Route::post('state/store', [App\Http\Controllers\StateController::class,'store'])->middleware(['auth'])->name('state/store');

Route::get('users/list', [App\Http\Controllers\UserController::class,'index'])->middleware(['auth'])->name('users.list');
Route::get('users/create', [App\Http\Controllers\UserController::class,'create'])->middleware(['auth']);
Route::get('users/{id}/show', [App\Http\Controllers\UserController::class,'show'])->middleware(['auth'])->name('users.show');
Route::get('users/{id}/edit', [App\Http\Controllers\UserController::class,'edit'])->middleware(['auth']);
Route::put('users/{id}', [App\Http\Controllers\UserController::class,'update'])->middleware(['auth']);
Route::delete('users/destroy/{id}', [App\Http\Controllers\UserController::class,'destroy'])->middleware(['auth'])->name('users.destroy');
Route::post('users/store', [App\Http\Controllers\UserController::class,'store'])->middleware(['auth'])->name('users.store');
Route::get('assign/{id}/create', [App\Http\Controllers\UserController::class,'assign'])->middleware(['auth']);
Route::post('assign/store', [App\Http\Controllers\UserController::class,'storeState'])->middleware(['auth']);

Route::get('products/list', function(){
    return view('product.index');
})->middleware(['auth']);


Route::get('sms-settings', [App\Http\Controllers\SmsController::class,'index'])->middleware(['auth']);

require __DIR__.'/auth.php';
