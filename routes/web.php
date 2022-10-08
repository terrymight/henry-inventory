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

Route::get('/', function(){
    return redirect('/login');
});
Route::get('/dashboard', [App\Http\Controllers\DashboardController::class,'index'])->middleware(['auth'])->name('dashboard');


Route::get('/track-order', [App\Http\Controllers\InvoiceController::class,'index'])->name('invoice.index');
Route::post('/find-invoice', [App\Http\Controllers\InvoiceController::class,'store']);
// Route::get('/find-invoice', [App\Http\Controllers\InvoiceController::class,'store']);

Route::get('application/list', [App\Http\Controllers\ApplicationController::class,'index'])->middleware(['auth'])->name('application.list');
Route::get('application/{id}/edit', [App\Http\Controllers\ApplicationController::class,'edit'])->middleware(['auth']);
Route::put('application/{id}', [App\Http\Controllers\ApplicationController::class,'update'])->middleware(['auth']);

Route::get('/customers/list', [App\Http\Controllers\CustomersController::class,'index'])->middleware(['auth'])->name('customers.list');
Route::get('/customer/create', [App\Http\Controllers\CustomersController::class,'create'])->middleware(['auth']);
Route::get('customer/{id}/edit', [App\Http\Controllers\CustomersController::class,'edit'])->middleware(['auth']);
Route::put('customer/{id}', [App\Http\Controllers\CustomersController::class,'update'])->middleware(['auth']);
Route::post('customer/notification/{id}', [App\Http\Controllers\CustomersController::class,'notify'])->middleware(['auth']);
Route::post('customer/store', [App\Http\Controllers\CustomersController::class,'store'])->middleware(['auth'])->name('customer/store');
Route::post('customer/destroy', [App\Http\Controllers\CustomersController::class,'destroy'])->middleware(['auth'])->name('customer.destroy');
Route::get('customer/show/{id}', [App\Http\Controllers\CustomersController::class,'show'])->middleware(['auth'])->name('customers.notify');
Route::get('customer/comment/destroy/{id}/{user_id}', [App\Http\Controllers\CustomersController::class,'commentDestroy'])->middleware(['auth','admin'])->name('comment.destroy');

Route::get('/comment/create/{id}', [App\Http\Controllers\CustomersController::class,'createComment'])->middleware(['auth']);
Route::post('/comment/store', [App\Http\Controllers\CustomersController::class,'storeComment'])->middleware(['auth']);

// changeStatus
Route::post('/comment/update/status', [App\Http\Controllers\CustomersController::class,'changeStatus'])->middleware(['auth']);


Route::get('state/list', [App\Http\Controllers\StateController::class,'index'])->middleware(['auth','admin']);
Route::get('state/create', [App\Http\Controllers\StateController::class,'create'])->middleware(['auth','admin']);
Route::get('state/{id}/edit', [App\Http\Controllers\StateController::class,'edit'])->middleware(['auth','admin']);
Route::put('state/{id}', [App\Http\Controllers\StateController::class,'update'])->middleware(['auth','admin']);
Route::post('state/destroy', [App\Http\Controllers\StateController::class,'destroy'])->middleware(['auth','admin'])->name('state.destroy');
Route::post('state/store', [App\Http\Controllers\StateController::class,'store'])->middleware(['auth','admin'])->name('state/store');

Route::get('users/list', [App\Http\Controllers\UserController::class,'index'])->middleware(['auth','admin'])->name('users.list');
Route::get('users/create', [App\Http\Controllers\UserController::class,'create'])->middleware(['auth','admin']);
Route::get('users/{id}/show', [App\Http\Controllers\UserController::class,'show'])->middleware(['auth','admin'])->name('users.show');
Route::get('users/{id}/edit', [App\Http\Controllers\UserController::class,'edit'])->middleware(['auth','admin']);
Route::put('users/{id}', [App\Http\Controllers\UserController::class,'update'])->middleware(['auth','admin']);
Route::post('users/destroy', [App\Http\Controllers\UserController::class,'destroy'])->middleware(['auth','admin'])->name('users.destroy');
Route::post('users/store', [App\Http\Controllers\UserController::class,'store'])->middleware(['auth','admin'])->name('users.store');
Route::get('assign/{id}/create', [App\Http\Controllers\UserController::class,'assign'])->middleware(['auth','admin']);
Route::post('assign/store', [App\Http\Controllers\UserController::class,'storeState'])->middleware(['auth','admin']);
Route::post('dispatcher/destroy', [App\Http\Controllers\UserController::class,'removeDispatcher'])->middleware(['auth','admin']);


Route::get('products/list', [App\Http\Controllers\ProductsController::class,'index'])->middleware(['auth','admin']);
Route::get('products/create', [App\Http\Controllers\ProductsController::class,'create'])->middleware(['auth','admin']);
Route::post('products/store', [App\Http\Controllers\ProductsController::class,'store'])->middleware(['auth','admin'])->name('products.store');
Route::get('products/{id}/edit', [App\Http\Controllers\ProductsController::class,'edit'])->middleware(['auth','admin']);
Route::put('products/{id}', [App\Http\Controllers\ProductsController::class,'update'])->middleware(['auth','admin']);
Route::post('products/destroy', [App\Http\Controllers\ProductsController::class,'destroy'])->middleware(['auth','admin'])->name('products.destroy');

Route::get('sms-settings', [App\Http\Controllers\SmsController::class,'index'])->middleware(['auth','admin'])->name('sms.index');
Route::post('sms-settings', [App\Http\Controllers\SmsController::class,'send'])->middleware(['auth','admin']);
require __DIR__.'/auth.php';

Route::get('staff/list', [App\Http\Controllers\StaffController::class,'index'])->middleware(['auth','admin'])->name('staff.list');
Route::get('staff/create', [App\Http\Controllers\StaffController::class,'create'])->middleware(['auth','admin']);
Route::get('staff/{id}/edit', [App\Http\Controllers\StaffController::class,'edit'])->middleware(['auth','admin']);
Route::put('staff/{id}', [App\Http\Controllers\StaffController::class,'update'])->middleware(['auth','admin']);
Route::post('staff/destroy', [App\Http\Controllers\StaffController::class,'destroy'])->middleware(['auth','admin'])->name('staff.destroy');
Route::post('staff/store', [App\Http\Controllers\StaffController::class,'store'])->middleware(['auth','admin'])->name('staff/store');

