<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Order;
use App\Product;
use Illuminate\Support\Facades\Auth;

class OrdersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // show recent order 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //chec
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * Confirm product purchase 
     *
     * @return void
     */
    public function confirm(Request $request)
    {

        $this->cleanSession($request);
        $id = $request->input('product');
        $quantity = $request->input('quantity');
        $request->session()->put('product', $id);
        $request->session()->put('quantity', $quantity);
        $product = Product::find($id);

        return view("orders.confirm", ['product' => $product, 'quantity' => $quantity ]);

    }

    /**
     * undocumented function
     *
     * @return void
     */
    public function add(Request $request)
    {
        if( !$request->session()->has('product') || !$request->session()->has('quantity') ){
            return redirect('/');
        }

        //Need refactor **********************************************************************
        //
        $productId = $request->session()->get('product');
        $quantity = $request->session()->get('quantity');
        $product = Product::find($productId);
        $product->bought += $quantity;
        $product->save();
        $order = Order::create();
        $order->save();
        $order->create();
        $order->products()->sync([$productId]);
        $order->products->first()->pivot->quantity = $quantity;
        $order->products->first()->pivot->save();
        return redirect('/');
        // redirec with flsh messaage !!!!!!
    }
    
    
    /**
     *  Check out user order
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function checkout( Request $request, $id )
    {
        $order = Order::find($id);
        $products = $order->products;
        $order->delivery()->create(['ship' => false, 'arrive' => false]);
        return view( "orders.checkout", ['products' => $products] );

    }


    /**
     * undocumented function
     *
     * @return void
     */
    public function flushOrder(Request $request)
    {
        $this->cleanSession($request);
        return redirect('/');
    }

    /**
     * undocumented function
     *
     * @return void
     */
    public function userOrders(Request $request)
    {
        $orders = Order::all();
        return view('orders.userorders', [ 'orders' => $orders ]);
        $orders = Auth::user()->orders;
        return $orders;
    }
    
    
    
    /**
     * undocumented function
     *
     * @return void
     */
    private function cleanSession(Request $request)
    {

        if ($request->session()->has('product')) {
            $request->session()->forget('product');
        }

        if ($request->session()->has('quantity')) {
            $request->session()->forget('quantity');
        }


    }


}

