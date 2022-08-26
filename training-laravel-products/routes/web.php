<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\MailController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Models\Customer;
use App\Models\Order;
use App\Models\Product;
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
Route::get('/index', [ProductController::class, 'index'])->middleware('guest');
Route::post('/index', [ProductController::class, 'add'])->middleware('guest');

Route::get('/cart', [ProductController::class, 'cart'])->middleware('guest');
Route::post('/cart', [ProductController::class, 'remove'])->middleware('guest');
Route::post('/cart/order', [OrderController::class, 'checkout'])->middleware('guest');

Route::get('/login', [LoginController::class, 'create'])->name('login')->middleware('guest');
Route::post('/login', [LoginController::class, 'login'])->middleware('guest');
Route::get('/logout', [LoginController::class, 'logout'])->middleware('auth');

Route::get('/products', [ProductController::class, 'products'])->middleware('auth');
Route::post('/products', [ProductController::class, 'delete'])->middleware('auth');

Route::get('/product', function () {
    return view('product');
})->middleware('auth');
Route::get('/product/{id}', function ($id) {
    return view('product', ['id' => $id]);
})->whereNumber('id')->middleware('auth');

Route::post('/product/{id}', [ProductController::class, 'edit'])->middleware('guest');
Route::post('/product', [ProductController::class, 'insert'])->middleware('guest');

Route::get('/order/{customer}', [OrderController::class, 'order'])->middleware('guest');

Route::get('/orders', function () {
    return view('orders', ['orders' => Customer::all()]);
})->middleware('guest');




