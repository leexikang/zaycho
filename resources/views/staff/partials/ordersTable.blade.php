    <table>
        <h4> Orders </h4>
        <thead>
            <tr>
                <th width="200">Name </th>
                <th width="300"> Products </th>
                <th width="100"> Total </th>
                <th width="150">Order Date</th>
                <th width="100"></th>
            </tr>
        </thead>
        <tbody>
            @foreach( $products as $product )
                @foreach( $product->orders as $order )
                    <tr>
                        <td> {!! $order->user->name !!} </td>
                        <td> {!! $order->user->name !!}
                            ( {!!  $product->price !!} x 
                            {!! $order->products->first()->pivot->quantity !!}
                            )
                        </td>
                        <td> {!! $order->total() !!} </td>
                        <td> {!! $order->created_at->toFormattedDateString() !!} </td>
                        @if( $product->canBuy() )
                            <td> <span class="success label"> Success </span> </td>
                        @else
                            <td> <span class="alert label"> Fail </span> </td>
                        @endif

                    </tr>
                @endforeach
            @endforeach
        </tbody>
    </table>
 
