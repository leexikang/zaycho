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
//Order Route
//
Route::post('orders/confirm', 'OrdersController@confirm');
Route::post('orders/add', 'OrdersController@add');

Route::get('orders/{id}/checkout', [ 'as' => 'checkout', 'uses' =>
    'OrdersController@checkout' ]);
Route::get('orders/{id}/purchase', 'PaymentsController@purchase');
//
//
Route::get('category/{name}', 'CategoriesController@show');
