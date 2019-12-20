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

Route::get('/', 'WeatherController@index');

Route::get('/weather', 'WeatherController@index');

Route::get('/order', 'OrderController@index');
Route::get('/order/update/{id}', 'OrderController@update');
Route::get('/order/{id}/edit', 'OrderController@edit');
Route::patch('/order/{id}', 'OrderController@update');

Route::get('/product', 'ProductController@index');
Route::post('/product/ajaxPrice', 'ProductController@ajaxPrice');