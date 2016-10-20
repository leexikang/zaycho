    <table>
        <h4> Orders </h4>
        <thead>
            <tr>
                <th width="200">Name </th>
                <th> Products </th>
                <th width="150"> Total </th>
                <th width="150">Order Date</th>
            </tr>
        </thead>
        <tbody>
            @foreach( $orders as $order )
                <tr>
                    <td> {!! $order->user->name !!} </td>
                    <td> {!! $order->products->first()->name !!}
                        ( {!!  $order->products->first()->price !!} x 
                        {!! $order->products->first()->pivot->quantity !!}
                        )
                    </td>
                    <td> {!! $order->total() !!} </td>
                    <td> {!! $order->created_at->toFormattedDateString() !!} </td>
                </tr>
            @endforeach
        </tbody>
    </table>
 
