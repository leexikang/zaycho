    <table>
        <h4> Orders </h4>
        <thead>
            <tr>

                <th width="200">Name </th>
                <th width="300"> Products </th>
                <th width="100"> Total </th>
                <th width="150">Order Date</th>
                <th width="100"></th>
                <th width="100"></th>
            </tr>
        </thead>
        <tbody>

            @foreach( $products as $index => $product )

                @foreach( $product->orders as $order )

                <tr>
                        <td> {!! $order->user->name !!} </td>
                        <td> {!! $product->name !!}
                            ( {!!  $product->price !!} x 
                            {!! $order->products->first()->pivot->quantity !!}
                            )
                        </td>
                        <td> {!! $order->total() !!} </td>
                        <td> {!! $order->created_at->toFormattedDateString() !!} </td>
                        @if( $product->expired() )
                            <td> <span class="alert label"> Fail </span> </td>
                        @elseif( $product->cannotBuy() )
                            <td> <span class="secondary label"> Pending </span> </td>
                        @else
                            <td> <span class="success label"> Success </span> </td>
                        @endif

                        <td>  <a href="#" class="button tiny expanded"> Edit </a> </td>

                    </tr>
                @endforeach
            @endforeach
        </tbody>
    </table>
 
