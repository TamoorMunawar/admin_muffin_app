<?php

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
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VedioController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\DeliveryController;

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('login2');
});

Route::get('/login2', function () {
    return view('login2');
})->name('login2');

Route::post('/login2', 'AuthController@login2')->name('login2.submit');

Route::post('/logout2', 'AuthController@logout2')->name('logout2');
Route::middleware(['Authenticattion'])->group(function () {

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/admin/add', 'ServiceController@showAddPage')->name('admin.add');

Route::patch('/user/update/{userId}', 'UserController@update')->name('user.update');
Route::get('/user/{userId}', 'UserController@edit')->name('user.edit');
Route::patch('/user/block/{userId}', 'UserController@block')->name('user.block');
Route::get('/userdetails/{userId}', 'UserController@show')->name('user.show');

Route::delete('/vedio/delete/{id}', 'VedioController@delete')->name('vedio.delete');

Route::delete('/store/delete/{id}', 'StoreController@delete')->name('store.delete');
Route::get('/storedetails/{userId}', 'StoreController@show')->name('store.show');
Route::patch('/store/block/{userId}', 'StoreController@block')->name('store.block');
Route::get('/store/{userId}', 'StoreController@edit')->name('store.edit');
Route::patch('/store/update/{userId}', 'StoreController@update')->name('store.update');

Route::get('/admin/product', 'ProductsController@showAddPage')->name('admin.product');
Route::get('/productdetails/{id}', 'ProductsController@show')->name('product.show');
Route::delete('/product/delete/{id}', 'ProductsController@delete')->name('product.delete');
Route::get('/product/{id}', 'ProductsController@edit')->name('product.edit');
Route::patch('/product/update/{id}', 'ProductsController@update')->name('product.update');

Route::patch('/admin/store/edit/{userId}', 'ServiceController@block')->name('store.block');
Route::post('/store/create', 'ServiceController@create')->name('store.create');
Route::get('/store/add', 'ServiceController@showstorePage')->name('admin.store');

Route::get('/admin/category', 'CategoryController@showcategoryPage')->name('admin.category');
Route::post('/category/create', 'CategoryController@create')->name('category.create');
Route::get('/categorydetails/{id}', 'CategoryController@show')->name('category.show');
Route::delete('/category/delete/{id}', 'CategoryController@delete')->name('category.delete');
Route::get('/category/{id}', 'CategoryController@edit')->name('category.edit');
Route::put('/category/update/{id}', 'CategoryController@update')->name('category.update');

Route::post('/delivery/create', 'DeliveryController@create')->name('delivery.create');
Route::get('/admin/delivery', 'DeliveryController@showdeliveryPage')->name('admin.delivery');


});