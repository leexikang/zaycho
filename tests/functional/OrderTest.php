<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Laracasts\TestDummy\Factory as TestDummy;

class OrderTest extends TestCase
{
    use DatabaseMigrations;
    use DatabaseTransactions;
    use WithoutMiddleware;

    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_it_checkout()
    {
        $products = $this->createProductFixture()->lists('id')->toArray();
        $order = TestDummy::create('App\Order', ['id' => '1']);
        $order->products()->sync($products);

        $this->visit("orders/" . $order->id . "/checkout")
            ->seeInDatabase('deliveries', ['ship' => '0'])
            ->see( $order->products->get(1)->name );

    }


    private function createProductFixture(){

        return TestDummy::times(5)->create('App\Product');

    }

}
