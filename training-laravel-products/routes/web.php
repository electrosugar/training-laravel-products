<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProductController;
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

Route::get('/login', [LoginController::class, 'create']);
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->middleware('auth');

Route::get('/products',[ProductController::class, 'products']);
Route::post('/products',[ProductController::class, 'delete']);

Route::get('/product', function () {
    return view('product');
});

Route::get('/index', [ProductController::class, 'index']);
Route::post('/index', [ProductController::class, 'add']);

Route::get('/cart', [ProductController::class, 'cart']);
Route::post('/cart', [ProductController::class, 'remove']);

Route::get('/order', function () {
    return view('order');
});

Route::get('/orders', function () {
    return view('orders');
});




