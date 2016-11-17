<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Order;
use App\Product;
use App\Invoice;
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
        return view('orders.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $order = Order::create([
            'valid' => $request->valid,
            'archive' => $request->archive,
            'user_id' => $request->user_id
        ]);
        $order->save();
        return redirect('staff/orders');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $order = Order::find($id);
        return view('orders.edit', ['order' => $order]);

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
        $order = Order::find($id);
        $order->archive = $request->archive;
        $order->valid = $request->valid;
        $order->user_id = $request->user_id;
        return redirect('/staff/orders');
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
        $userId = Auth::user()->id;
        $productId = $request->session()->get('product');
        $quantity = $request->session()->get('quantity');
        $product = Product::find($productId);
        $product->bought += $quantity;
        $product->save();
        $order = Order::create(['user_id' => $userId]);
        $order->save();
        $order->products()->sync([$productId]);
        $order->products->first()->pivot->quantity = $quantity;
        $order->products->first()->pivot->save();
        return redirect('/user/orders');
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
        return view( "orders.checkout", ['order' => $order] );

    }


    public function editAddress($id)
    {
        $order = Order::find($id);
        return view('orders.updateAddress', ['order' => $order]);

    }
    public function updateAddress(Request $request, $id)
    {
        $order = Order::find($id);
        $order->user->address = $request->address;
        $order->user->save();

        return redirect()
            ->route('purchase', ['id' => $order->id]);
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
    //    $userId = Auth::user()->id;
        //$sends = Order::where(['archive' => true, 'user_id' => $userId])->get();
        //return $orders = Order::where(['archive' => false, 'user_id' => $userId])->with('products')->get()->sortByDesc('created_at');
        //$orders = Order::where(['archive' => false, 'user_id' => $userId])->with('products')->get()->sortByDesc('created_at');
        $orders = Order::with('user', 'products', 'invoice', 'delivery')
            ->where(['user_id' => Auth::user()->id])
            ->orderBy('created_at', 'desc')->get();
        return view('orders.userorders', [ 'orders' => $orders]);
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

        return redirect('staff/orders');
