<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Laracasts\TestDummy\Factory as TestDummy;

class CategoryTest extends TestCase
{
    use DatabaseMigrations;
    use DatabaseTransactions;
 
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_it_fetch_products_by_category()
    {
        TestDummy::create('App\Category', [ "name" => "health" ] );
        $product = TestDummy::create('App\Product', [ "category_id" => 1 ] );
        $this->visit('category/health')
            ->see($product->name);

    }

   
    
}
