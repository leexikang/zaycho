@extends('app')

@section('content')
    <br>
    <br>
    <div class="row">

        <ul class="tabs" data-tabs id="example-tabs">
            <li class="tabs-title is-active"><a href="#panel1" aria-selected="true"> Orders </a></li>
            <li class="tabs-title"><a href="#panel2"> Invoices </a></li>
            <li class="tabs-title"><a href="#panel3"> Shipping </a></li>
        </ul>

        <div class="tabs-content" data-tabs-content="example-tabs">
            <div class="tabs-panel is-active" id="panel1">
                @if( !empty($orders) )
                    @foreach( $orders as $order )
                        @include("layouts.ordertab")
                    @endforeach
                @else
                    <h3> No Order Found..... </h3>
                @endif


            </div>


            <div class="tabs-panel" id="panel2">
                <div class="row">
                    <div class="small-10 small-centered columns">
                        <div class="row">


                            <table>
                                <thead>
                                    <tr>
                                        <th width="100">Invoice ID </th>
                                        <th width="200">  Products </th>
                                        <th width="150"> Total </th>
                                        <th width="150"> Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach( $orders as $order )
                                        @if($order->invoice)
                                        <tr>
                                        <td> {!! $order->invoice->id !!} </td>
                                            <td> {!! $order->products->first()->name !!} 
                                                    ( {!! $order->products->first()->price !!}  x
                                                    {!! $order->products->first()->pivot->quantity !!}  )
                                            </td>
                                            <td> {!! $order->products->first()->price * $order->products->first()->pivot->quantity !!}  Kyats
                                            </td>
                                            <td> {!! $order->invoice->created_at->toFormattedDateString() !!} </td>
                                        </tr>
                                    @endif
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>

            {{--tab 3--}}
            <div class="tabs-panel" id="panel3">
                <div class="row">
                    <div class="small-10 small-centered columns">
                        <div class="row">


                            <table>
                                <thead>
                                    <tr>
                                        <th width="100">Shipping ID </th>
                                        <th width="200">  Products </th>
                                        <th width="200"> Address </th>
                                        <th width="150"> Date</th>
                                        <th width="100"> </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach( $orders as $order )
                                        @if($order->delivery)
                                        <tr>
                                        <td> {!! $order->delivery->id !!} </td>
                                            <td> {!! $order->products->first()->name !!} 
                                                ( {!! $order->products->first()->pivot->quantity !!}  )
                                            </td>
                                            <td> {!!$order->user['address'] !!}  </td>
                                            <td> {!! $order->delivery->created_at->toFormattedDateString() !!} </td>
                                            <td>
                                            @if($order->delivery['arrive'])
                                                <span class="success label"> Aarrived </span>
                                            @elseif($order->delivery['ship'])
                                                <span class="secondary label"> Shipped </span>
                                            @else
                                                <span class="warning label"> Pending </span>
                                            @endif

                                            </td>
                                        </tr>
                                    @endif
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>


            
{{--row--}}
    </div>
    </div>
    <br>

@endsection
 
