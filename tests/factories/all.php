<?php
$factory('App\Product', [
    'name' => $faker->name,
    'price' => $faker->numberBetween(100, 10000)
]);
