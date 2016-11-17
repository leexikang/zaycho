@extends('app')
@section('content')
    <br/><br/>
    <div class="row">
        <div class="small-8 small-centered columns">

            @foreach($order->products as $product)
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
                        <img src="/{!! $product->photos->where('main', 1)->first()->thumbnail_path !!}">
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
                    <span> {!! $quantity = $product->pivot->quantity !!} x {!! $price = $product->price !!} = {!! $price * $quantity !!} Kyats </span>
                </div>
           </div>

            <div class="row">
                <div class="small-2 small-offset-10 columns">
                    <br/>
                    <a href="{!! url('order/' . $order->id  . '/address/edit') !!}" class="expended button"> Confirm </a>
                </div>
            </div>

            </div>

        @endforeach

            </div>

            
    </div>

@endsection
