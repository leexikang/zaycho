<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Laracasts\TestDummy\Factory as TestDummy;

class ProductUnitTest extends TestCase
{
    use DatabaseMigrations;
    use DatabaseTransactions;
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testProductCanBeBought(){

        $product = TestDummy::build('App\Product', ['signup' => 1000,
            'bought' => 1100,
            'due_date' => new DateTime('tomorrow')
        ]);
        $this->assertTrue($product->canBought());
    }

    public function testProdductCannotBought(){

         $product = TestDummy::build('App\Product', ['signup' => 1000,
            'bought' => 100,
            'due_date' => new DateTime('tomorrow')
        ]);
        $this->assertFalse($product->canBought());

    }

    /**
     * Test Date is Due
     *
     * @return void
     */
    public function testDateIsDue()
    {
        $product = TestDummy::build('App\Product', ["due_date" => new DateTime('yesterday') ]); 
        $this->assertTrue($product->isDue());
    }

    /**
     * Test Date is not Due
     *
     * @return void
     */
    public function testDateIsNotDue()
    {
        $product = TestDummy::build('App\Product', ["due_date" => new DateTime('tomorrow') ]); 
        $this->assertFalse($product->isDue());
    }


}
