<?php

use Illuminate\Database\Seeder;

class StaffsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Staff::class)->create(['name' => 'Min San', 'email' => 'min@example.com']); 
    }
}
