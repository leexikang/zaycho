<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

// User Table Factory

$factory->define(App\User::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->safeEmail,
        'password' => bcrypt("password"),
        'address' => $faker->streetAddress,
        'remember_token' => str_random(10),
    ];
});

// Product Table Factory 
//
$factory->define(App\Product::class, function (Faker\Generator $faker) {
    return [
        'name' => 'Samsung' . $faker->randomNumber(4),
        'price' => $faker->randomNumber(3),
        'minimun_sale' => 200,
        'bought' => $faker->biasedNumberBetween(50, 300),
        'due_date' => $faker->dateTimeThisYear('December')->format('Y-m-d'),
        'category_id' => $faker->numberBetween(1,5),
        'supplier_id' => $faker->numberBetween(1,10)
    ];
});

// Ordre Table Factory
//
$factory->define(App\Order::class, function (Faker\Generator $faker) {
    return [
        'archive' => $faker->boolean(3),
    ];
});


// Supplier Table Factory
//
$factory->define(App\Supplier::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->company(),
        'address' => $faker->streetAddress,
    ];
});


