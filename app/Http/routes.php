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

Route::get('test/', function(){
    return env('DB_DATABASE'); 
});

Route::get('/startup', 'StartupController@startup');
Route::get('/initdatabase', 'StartupController@initDatabase');

Route::get('/', 'ProductsController@index');
Route::get('/products/s', 'ProductsController@search');

Route::get('products/{id}/photos', [
    'as' => 'product.photo',
    'uses' => 'ProductsController@uploadPhoto'
]);

Route::post('products/{id}/photos', 'ProductsController@addPhoto');
Route::post('products/{id}/mainphoto', 'ProductsController@addMainPhoto');


//Order Route
//
//
Route::resource('products', 'ProductsController');

Route::group(['middleware' => ['staff.auth']], function(){
    Route::resource('orders', 'OrdersController');
});

Route::group(['middleware' => ['web', 'auth']], function(){
    Route::get('order/{id}/address/edit', 'OrdersController@editAddress');
    Route::patch('order/{id}/address/update', 'OrdersController@updateAddress');
    Route::get('user/orders','OrdersController@userOrders');
    Route::get('order/confirm', 'OrdersController@confirm');
    Route::get('order/remove', 'OrdersController@flushOrder');
    Route::get('order/add', 'OrdersController@add');

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
//

Route::group(['prefix' => 'staff'], function(){
    Route::get('/login', 'StaffsAuthController@getLogin');
    Route::post('/login', 'StaffsAuthController@login');
    Route::get('/logout', 'StaffsAuthController@logout');
});


Route::group(['prefix' => 'staff',
    'middleware' => 'staff.auth'], function(){

    Route::resource('users','UsersController');
    Route::get('/', 'AdminstrationController@index');
    Route::get('orders', 'AdminstrationController@orders');
    Route::get('payments', 'AdminstrationController@payments');
    Route::get('deliveries', 'AdminstrationController@deliveries');
    Route::get('products', 'AdminstrationController@products');

    Route::get('delivery/{id}/ship', 'DeliveriesController@ship');
    Route::get('delivery/{id}/arrive', 'DeliveriesController@arrive');
    Route::get('payment/{id}/pay', 'AdminstrationController@pay');
});

