<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Payment;

use App\Order;

class PaymentsController extends Controller
{
    /**
     * Give payment inofrmation
     *
     * @return void
     */
    public function purchase(Request $request, $orderId)
    {
        $order = Order::find($orderId);
        $order->delivery()->create(['ship' => false, 'arrive' => false]);

        Payment::create([
            'order_id' => $orderId,
            'user_id' => 1
        ]);
        // user inforamtion 
        $account = ["number" => "121312",
            "phone" => "01-333312",
            "address" => "15 street Yangon"
        ];
        return view("payments.purchase", ['account' => $account,
        'order' => $order]);
    }
    
}
