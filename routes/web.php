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


Auth::routes();

Route::get('/', 'ProductController@index');

Route::get('cart', 'CartController@cart');
 
Route::get('add-to-cart/{id}', 'CartController@addToCart');
	
Route::patch('update-cart', 'CartController@update');
 
Route::delete('remove-from-cart', 'CartController@remove');

Route::get('set-order','OrderController@setOrder')->middleware('auth');

Route::get('/orders', 'OrderController@getOrders')->middleware('auth');

Route::get('/orders/{id}','OrderController@showOrder')->middleware('auth');

Route::get('/update-status/{id}/{status}', 'OrderController@updateStatus')->middleware('auth');

