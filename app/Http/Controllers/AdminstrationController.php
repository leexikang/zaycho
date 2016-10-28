<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Delivery;

use App\Payment;

use App\Order;

use App\Product;
class AdminstrationController extends Controller
{
    public function index()
    {

        $products = Product::Due()->with('orders')->take(8)->orderBy('created_at')->get();
        $deliveries = Delivery::take(8)->orderBy('created_at')->get();
        $payments = Payment::New()->take(8)->orderBy('created_at')->get();
        return view('staff.home', ['products' => $products, 
            'deliveries' => $deliveries ,
            'payments' => $payments
        ]);
    }

    /**
     * undocumented function
     *
     * @return void
     */
    public function orders(Request $request)
    {

        $products = Product::Due()->with('orders')->take(8)->orderBy('created_at')->get();
        return view('staff.orders', ['products' => $products]);
    }

    /**
     * undocumented function
     *
     * @return void
     */
    public function payments(Request $request)
    {
        $payments = Payment::New()->orderBy('created_at')->get();
        return view('staff.payments', ['payments' => $payments]);

    }

    /**
     * undocumented function
     *
     * @return void
     */
    public function deliveries(Request $request)
    {
        $deliveries = Delivery::orderBy('created_at')->get();
        return view('staff.deliveries', ['deliveries' => $deliveries]);
    }
    
    
    
}
