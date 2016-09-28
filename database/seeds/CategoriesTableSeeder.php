<?php

use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [ 'Eletronices', 'Sport', 'Home&Garden', 'Health&Beauty', 'Fashion', 'Food&Drink' ];

        foreach( $categories as $value){

            DB::table('categories')->insert([
                'name' => $value,
            ]);
        }

    }
}
