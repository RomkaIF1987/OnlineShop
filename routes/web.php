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

Route::get('/', 'Controller@index')->name('home.page');
Route::resource('products', 'ProductController');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('add-to-cart/{id}', 'CartController@getAddToCart')->name('addToCart');
Route::get('cart-show', 'CartController@getCart')->name('cartShow');
Route::get('cart-confirm/{order}', 'CartController@getCartConfirm')->name('cartConfirm');
Route::get('reduce/{id}', 'CartController@getReduceByOne')->name('reduceByOneCart');
Route::post('update/{id}', 'CartController@getUpdateItem')->name('updateCart');
Route::get('remove/{id}', 'CartController@getRemoveItem')->name('removeItemCart');

Route::resource('orders', 'OrderController');

Route::post('rating/{product}', 'RatingController@store')->name('rating.store');