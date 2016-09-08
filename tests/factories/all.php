<?php
$factory('App\Product', [
    'name' => $faker->randomNumber(3),
    'price' => $faker->numberBetween(100, 10000),
    'bought' => $faker->biasedNumberBetween(50, 300),
    'due_date' => '2017-02-02'
]);


$factory('App\Order', [
    'archive' => $faker->boolean(3),
]);




