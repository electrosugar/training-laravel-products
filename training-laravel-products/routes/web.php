<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProductController;
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

Route::get('/login', [LoginController::class, 'create']);
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->middleware('auth');

Route::get('/products', [ProductController::class, 'products']);
Route::post('/products', [ProductController::class, 'delete']);

Route::get('/product/', function () {
    return view('product');
});
Route::get('/product/{id}', function ($id) {
    return view('product', ['id' => $id]);
})->whereNumber('id');

Route::post('/product/{id}', [ProductController::class, 'edit']);
Route::post('/product', [ProductController::class, 'insert']);


Route::get('/index', [ProductController::class, 'index']);
Route::post('/index', [ProductController::class, 'add']);

Route::get('/cart', [ProductController::class, 'cart']);
Route::post('/cart', [ProductController::class, 'remove']);

Route::get('/order', function () {
    $product = new Product(
        1,
        'Windows',
        'OS',
        10.2,
        'storage/images/GkTGYwMb6IWqdh1nfe6JNQcMCvLAWs3sHjrNJk6C.png'
    );
    $order = new Order(
        'Maria',
        'maria@gmail.com',
        'I love buying stuff',
        100,
        [$product]
    );
    return view('order', ['order' => $order]);
});

Route::get('/orders', function () {
    return view('orders');
});




