<?php

use Illuminate\Database\Seeder;

class OrdersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        factory(App\Order::class, 20)->create()->each(function($u) {
            $id = $u->user_id;
            $u->payment()->save(factory('App\Payment')->make(['user_id' => $id]));
            $u->products()->save(App\Product::all()->random());
            $u->delivery()->save(factory('App\Delivery')->make());
        });
    }
}
