<?php

namespace App\Providers;

use App\Category;
use App\Order;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Auth;
use DB;

class ViewComposerServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('partials.subnav', function($view){
            $view->with('categories', Category::all());
        });

        view()->composer('partials.nav', function($view){
            if(Auth::check()){
                $count = sizeOf(DB::select(DB::raw(
                    "SELECT *
                    from users, products, orders, order_details
                    where users.id = orders.user_id
                    and order_details.order_id = orders.id
                    and order_details.product_id = products.id
                    and products.due_date < '" .date('Y-m-d'). "'
                    and products.bought > products.minimun_sale
                    and orders.user_id = ". Auth::user()->id . "
                    and orders.checkout = 0;"
                )));

                $view->with('notifications', $count);
            }
        });


    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
