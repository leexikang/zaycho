@extends('app')

@section('content')
    <br>
    <br>
    <div class="row">

        <ul class="tabs" data-tabs id="example-tabs">
            <li class="tabs-title is-active"><a href="#panel1" aria-selected="true"> Panding </a></li>

            <li class="tabs-title"><a href="#panel2"> History </a></li>
        </ul>

        <div class="tabs-content" data-tabs-content="example-tabs">
            <div class="tabs-panel is-active" id="panel1">

                @foreach( $orders as $order )

                    <div class="row">
                        <div class="small-10 small-centered columns">
                            <div class="media-object">
                                <div class="media-object-section">
                                    <div class="thumbnail">
                                        <img src="//placehold.it/100x100">
                                    </div>
                                </div>
                                <div class="media-object-section">

                                    <h5> {!! $order->products->first()->name !!} </h5>
                                    <p> {!! $order->created_at->format('d-m-Y') !!} </p>
                                    <p> <strong> Total: </strong> 
                                    {!! $order->products->first()->price * $order->products->first()->pivot->quantity !!} Kyats
                                    </p>
                                </div>
                            </div>

                            <hr/>

                        </div>
                    </div>
                @endforeach
            </div>

            <div class="tabs-panel" id="panel2">
                <h1> History </h1>
                @foreach( $sends as $order )

                    <div class="row">
                        <div class="small-10 small-centered columns">
                            <div class="media-object">
                                <div class="media-object-section">
                                    <div class="thumbnail">
                                        <img src="//placehold.it/100x100">
                                    </div>
                                </div>
                                <div class="media-object-section">

                                    <h5> {!! $order->products->first()->name !!} </h5>
                                    <p> {!! $order->created_at->format('d-m-Y') !!} </p>
                                    <p> <strong> Total: </strong> 
                                    {!! $order->products->first()->price * $order->products->first()->pivot->quantity !!} Kyats
                                    </p>
                                </div>
                            </div>

                            <hr/>

                        </div>
                    </div>
                @endforeach


            </div>
        </div>

    </div>

@endsection
 
