<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    //return view('welcome');
    return "hello";
});

Route::resource('products', 'ProductsController');
Route::get('products/{id}/confirm', 'ProductsController@confirm');
Route::get('orders/{id}/checkout', 'OrdersController@checkout');
Route::get('orders/{id}/purchase', 'PaymentsController@purchase');
