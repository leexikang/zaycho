<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Delivery;

use App\Payment;

use App\Order;

class AdminstrationController extends Controller
{
    public function index()
    {

        $orders = Order::New()->take(8)->orderBy('created_at')->get();
        $deliveries = Delivery::take(8)->orderBy('created_at')->get();
        $payments = Payment::New()->take(8)->orderBy('created_at')->get();
        return view('staff.home', ['orders' => $orders, 
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
        $orders = Order::New()->orderBy('created_at')->get();
        return view('staff.orders', ['orders' => $orders]);

    }
    
}
