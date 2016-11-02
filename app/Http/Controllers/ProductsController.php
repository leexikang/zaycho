<?php

namespace App\Http\Controllers;

use Image;
use App\Product;
use App\Photo;
use App\Http\Requests;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $products = Product::latest()->get();
        return view("products.index", ['products' => $products]);
    }

    /**
     * Confirm the products purchase
     *
     * @return void
     */
    public function confirm(Request $request, $id)
    {
        $product = Product::find($id);
        $product->bought += 1;
        $product->save();
        $order =  $product->orders()->create(["valid" => false]);
        return redirect()->route('checkout', ['id' =>  $order->id]);

    }
    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       return view('products.create'); 
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $product = Product::create($request->all());
        return redirect()->route('products.show', $product->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product  = Product::findOrFail($id);
        return view("products.show", ['product' => $product]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::find($id);
        return view('products.edit', compact('product'));
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
        $product = Product::find($id);
        $product->update($request->all());
        return $product;
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


    //
    //
    /**
     * undocumented function
     *
     * @return void
     */
    public function addPhoto($id, Request $request)
    {
        $product = Product::find($id);
        $this->processPhotos($product, $request->file('photos'));
        return 'Done';
    }

    public function uploadPhoto($id, Request $request){
        $product = Product::findOrFail($id);
        return view('products.uploadPhoto', ['product' => $product]);
    }

    public function addMainPhoto($id, Request $request){

        $product = Product::find($id);
        $this->processPhotos($product, $request->file('mainPhoto'), true);
        return 'Done';
    }

    private function processPhotos($product, $photos, $main = false)
    {
        $photo = Photo::fromForm($photos);
        $product->addPhoto($photo, $main);
    
    }


    
}
    
