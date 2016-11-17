<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Delivery;

use App\Payment;

use App\Order;

use App\Product;

use App\Invoice;

class AdminstrationController extends Controller
{
    public function index()
    {

        $products = Product::with('orders')->take(8)->orderBy('created_at')->get();
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
        
        if($request->by){
            $fun = $request->by;
            $products = Product::with('orders')->$fun()->get();
        }else{

            $products = Product::with('orders')->get();
        }        
        return view('staff.orders', ['products' => $products]);
    }


    public function products(Request $request)
    {
        $products = $this->byOrder(Product::with('supplier', 'category')->get(), $request->by, 'created_at');
        //$fun = $request->by;
        //$products = Product::with('supplier', 'category')->$fun()->get();
        return view('staff.products', ['products' => $products]);
    }

    private function byOrder($collection, $order, $column)
    {
        if($order == 'desc'){
            return $collection->sortByDesc($column);
        }
            return $collection->sortBy($column);
    }

    private function byType($model, $by, $with){

        if(isset($by)){
            return $models = $model::with($with)->$by()->get()->sortByDesc('created_at');
        }else{
            return $models = $model::with($with)->get()->sortByDesc('created_at');
        }

    }
    /**
     * undocumented function
     *
     * @return void
     */
    public function payments(Request $request)
    {
        $payments = $this->byType( new Payment, $request->by, 'user');
        return view('staff.payments', ['payments' => $payments]);

    }

    /**
     * undocumented function
     *
     * @return void
     */
    public function deliveries(Request $request)
    {
        $deliveries = $this->byType(new Delivery, $request->by, 'order');
        return view('staff.deliveries', ['deliveries' => $deliveries]);
    }

    public function pay(Request $request, $id)
    {
        $payment = Payment::find($id);
        $order =  $payment->order;
        Invoice::create(['order_id' => $order->id]);
        $payment->pay = 1;
        $payment->save();
        return redirect()->back();

    }
    
    
}
