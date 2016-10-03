<?php

$factory('App\User', [ 
    'name' => $faker->name,
    'email' => $faker->safeEmail,
    'password' => bcrypt("password"),
    'address' => $faker->streetAddress,
    'remember_token' => str_random(10),
]);


$factory('App\Product', [
    'name' => $faker->randomNumber(3),
    'price' => $faker->numberBetween(100, 10000),
    'bought' => $faker->biasedNumberBetween(50, 300),
    'due_date' => '2017-02-02',
     'category_id' => 1,
     'supplier_id' => 1,
]);


$factory('App\Order', [
    'archive' => $faker->boolean(3),
]);


$factory('App\Category', [
    'name' => "Health"
]);

$factory('App\Supplier', [
    'name' => $faker->company(),
    'address' => $faker->address()
]);




