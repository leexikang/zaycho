@extends('app')
@section('content')
    <br/><br/>
    <div class="row">
        <div class="small-8 small-centered columns">

            <div class="row">
                <div class="small-12 columns checkout_header">
                    <h4> Cart  <h4>
                </div>
                <br/>
            </div>

            <div class="row checkout_wrapper">
                <div class="small-7 columns">
                    <div class="media-object">
                        <div class="media-object-section">
                            <div class="thumbnail">
                                <img src="//placehold.it/100x100">
                            </div>
                        </div>
                        <div class="media-object-section">
                            <br/>
                            <h5> <a href="{!! route('products.show', ['id' => $product->id]) !!}"> {!! $product->name !!} </a> </h5>
                        </div>
                    </div>
                </div>
                <div class="small-3 columns">
                    <br/>
                    <span> {!! $quantity !!} x {!! $price = $product->price !!} = {!! $price * $quantity !!} Kyats </span>
                </div>
                <div class="small-2 columns">
                    <br/>
                    <a href="{!! url('orders/remove') !!}" class="alert small hollow button"> remove </a>
                </div>
            </div>

            <div class="row">
                <div class="small-4 small-offset-8 columns">
                    <br/>
                    <a href="{!! url('orders/add') !!}" class="button"> Confirm </a>
                    <a href="{!! url('/products') !!}" class="expaneded button"> Back to Shopping</a>
                </div>
            </div>

            </div>



            </div>

            
    </div>

@endsection
