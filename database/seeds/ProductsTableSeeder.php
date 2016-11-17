<?php

use Illuminate\Database\Seeder;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Product::class, 20)->create()->each(function($u){
            $u->photos()
                ->save(factory('App\Photo')
                ->make(['main' => 1]));
            $u->photos()->save(factory('App\Photo')->make());
            $u->photos()->save(factory('App\Photo')->make());
            $u->photos()->save(factory('App\Photo')->make());

        });
    }
}
