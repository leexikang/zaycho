<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Laracasts\TestDummy\Factory as TestDummy;

class OrderTest extends TestCase
{
    use DatabaseMigrations;
    use DatabaseTransactions;

    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_it_checkout()
    {
    
    }

    public function test_it_redirect_when_no_product_session(){
        $this->visit('orders/add')
            ->seePageIs('/');
    }

    public function test_it_remove_the_order(){

        $this->withSession(['product' => 1, 'quantity', 11])
            ->visit('orders/remove')
            ->seePageIs('/');

    }

    public function test_it_show_user_orders(){

        $order = $this->createFixture();

        $this->actingAs($order->user)
            ->visit('/user/orders')
            ->see($order->products->first()->name);

    }

    private function createFixture(){

        $user = Factory(App\User::class)->create();
        $product = TestDummy::create('App\Product');
        $order = TestDummy::create('App\Order', ['user_id' => $user->id]);
        $order->products()->sync([$product->id]);
        $order->products->first()->pivot->quantity = 1;
        $order->products->first()->pivot->save();
        return $order;

    }

}
