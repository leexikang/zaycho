@extends('app')
@section('content')
    <br/>
    <br/>
    <div class="row">
        <div class="small-8 small-centered columns"> 
            <div class="row">
                <div class="small-4 columns">
                    <span class="subheader"> To: </span>
                    <h5> {!! $order->user->name !!}</h5>
                    <span class="subheader"> {!! $order->user->address !!}</span>
                </div>
                <div class="small-8 columns">

                    <h5 class="subheader text-right"> Invocie </h5>
                    <p class="text-right">
                    #{!! $order->id !!}<br/>
                    {!! $order->created_at->toFormattedDateString() !!}
                    </p>

                </div>
            </div>
        </div>
    </div>

    <br/>
    <br/>
    <div class="row">
        <div class="small-8 small-centered columns"> 
            <table>
                <thead>
                    <tr>
                        <th width="10%"> Quantity </th>
                        <th width="50%"> Description </th>
                        <th width="20%"> Unit Price </th>
                        <th width="20%"> Ammount </th>
                    </tr>
                </thead>
                <tbody>

                    @foreach( $order->products as $product )
                        <tr>
                            <td> {!! $quantity = $product->pivot->quantity !!} </td>
                            <td> {!! $product->name !!} </td>
                            <td> {!! $product->price !!} Kyats</td>
                            <td> {!! $product->price * $quantity !!} Kyats</td>
                        </tr>
                    @endforeach
                    <tr>
                        <td colspan='2'></td>
                        <td> Total: </td>
                        <td> {!! $product->price * $quantity !!} Kyats </td>
                    </tr>
                </tbody>
            </table>
            <br/>
            <hr/>
            <div class="callout alert">
                <h5 style="color:red"> ! Please Tranfer the balance to the follwing account 123KB12442 </h5>
                <p>
                    Zaycho .Inc
                <br/>
                <small> #21 Aung Chang Tar Road  </small> <br/>
                <small> San Chaung </small> <br/>
                <small> Yangon </small> <br/>
                <small> +951500989 </small>
                
                
                </p>
            </div>
        <br/> <a href="/"> Go Back </a>
        </div>
    </div>

@endsection
