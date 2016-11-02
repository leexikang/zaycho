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

Route::get('products/{id}/photos', 'ProductsController@uploadPhoto');
Route::post('products/{id}/photos', 'ProductsController@addPhoto');
Route::post('products/{id}/mainphoto', 'ProductsController@addMainPhoto');
Route::resource('products', 'ProductsController');

Route::get('user/orders','OrdersController@userOrders');
Route::resource('orders', 'OrdersController');
//Order Route
//

Route::group(['middleware' => ['web']], function(){
Route::post('orders/confirm', 'OrdersController@confirm');
Route::get('orders/add', 'OrdersController@add');
Route::get('orders/remove', 'OrdersController@flushOrder');

});

Route::get('orders/{id}/checkout', [ 'as' => 'checkout', 'uses' =>
    'OrdersController@checkout' ]);
Route::get('orders/{id}/purchase', 'PaymentsController@purchase');

//Category
Route::get('category/{name}', 'CategoriesController@show');
//Payment
Route::get('order/{id}/payment', ['as' => 'purchase', 
    'uses' => 'PaymentsController@purchase'
]);

// Authentication 
Route::auth();
Route::get('/home', 'HomeController@index');


// Admin Authentication

Route::group(['middleware' => ['web']], function () {
    //Login Routes...
    Route::get('/staff/login','StaffAuth\AuthController@showLoginForm');
    Route::post('/staff/login','StaffAuth\AuthController@authenticate');
    Route::get('/staff/logout','StaffAUth\AuthController@logout');

    // Registration Routes...
    Route::get('staff/register', 'StaffAuth\AuthController@showRegistrationForm');
    Route::post('staff/register', 'StaffAuth\AuthController@register');


});  
//for staff
Route::get('/staff', 'AdminstrationController@index');

Route::group(['prefix' => 'staff'], function(){

    Route::get('orders', 'AdminstrationController@orders');
    Route::get('payments', 'AdminstrationController@payments');
    Route::get('deliveries', 'AdminstrationController@deliveries');

});

