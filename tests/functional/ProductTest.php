<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Laracasts\TestDummy\Factory as TestDummy;
use Carbon\Carbon;

class ProductTest extends TestCase
{
    use DatabaseMigrations;
    use DatabaseTransactions;

    public function testshowproduct(){


        $this->createDependencyTable();
        TestDummy::create('App\Product', ['name' => 'Samsung', 
            'category_id' => "1",
            'supplier_id' => "1",
        ]);

        $this->visit('/products')
            ->see('Samsung');
         //   ->see('Hello');
   }

    /**
     * redirect usr for signup waiting list
     *
     * @return void
     */
    public function testUserWaitingListSignup()
    {
        $fixture = $this->getFixture();
        $fixture['bought'] = 0;
        TestDummy::create('App\Product', $fixture);
        $this->visit('/products')
            ->click('See More')
            ->type(11, 'quantity')
            ->press('Buy')
            ->seePageIs('orders/confirm')
            ->see($fixture['name'])
            ->see(11)
            ->click('add')
            ->seeInDatabase('products', ['id' => '1', 'bought' => '11' ])
            ->seeInDatabase('order_details', ['product_id' => '1',
            'quantity' => '11'
        ]);

    }

  
   /**
     * Test the product is due
     *
     * @return void

    public function testDueDate()
    {
        $fixture = $this->getFixture();
        $fixture["due_date"] = '2016-01-21';

        TestDummy::create('App\Product', $fixture);
        $this->buyProduct()->see('Cannot Bought');
    }

     /**
     * undocumented function
     *
     * @return void
    */

    public function test_it_create_prodcut()
    {
        $product = $this->getFixture();
        $product['due_date'] = '2016-05-10 00:00:00';
        $product['bought'] = '0';
        $this->visit('products/create')
            ->seePageIs('products/create')
            ->type($product['name'], 'name')
            ->type($product['price'], 'price')
            ->type($product['minimun_sale'], 'minimun_sale')
            ->type($product['due_date'], 'due_date')
            ->press('create')
    //        ->dump();
            ->seeInDatabase('products', ['bought' => $product['bought']])
            ->seePageIs('products/1');
    }
    
    /**
     * undocumented function
     *
     * @return void
     */
    public function test_it_update_it()
    {
        $product = ['name' => 'Sony', 
            'price' => 1300,
            'minimun_sale' => 400,
            'due_date' => "2016-05-10 00:00:00"
        ];

        $fixture = $this->getFixture();
        TestDummy::create('App\Product', $fixture); 
        $this->visit('/products/1/edit')
            ->see($fixture['name'])
            ->type($product['name'], 'name')
            ->type($product['price'], 'price')
            ->type($product['minimun_sale'], 'minimun_sale')
            ->type($product['due_date'], 'due_date')
            ->press('create')
            ->seeInDatabase('products', $product);

    }
    
    /**
     * Buy product procedure
     *
     * @return void
     */
    public function createCategory()
    {
        TestDummy::create('App\Category', ['id' => 1]);
    }

    public function createSupplier()
    {
        TestDummy::create('App\Supplier', ['id' => 1]);
    }

    public function createDependencyTable(){

        $this->createCategory();
        $this->createSupplier();

    }


    /**
     * return fixture
     
     * @return array
     */
    private function getFixture()
    {
        $this->createDependencyTable();

/*        TestDummy::create('App\Category', ['id' => 1]);*/
        /*TestDummy::create('App\Supplier', ['id' => 1]);*/
        return [
            "id" => 1,
            "name" => "Samsung",
            "price" => 12000,
            "minimun_sale" => 200,
            "bought" => 300,
            "due_date" => Carbon::tomorrow()->format('Y-m-d'),
            "category_id" => 1,
            "supplier_id" => 1,
        ];


    }

}
