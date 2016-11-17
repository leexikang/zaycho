    <table>
        <h4> Delivery </h4>
        <thead>
            <tr>
                <th width="50"> ID</th>
                <th width="100"> Name </th>
                <th width="200"> Address </th>
                <th width="150"> Date</th>
                <th width="50"></th>
            </tr>
        </thead>
        <tbody>
            @foreach( $deliveries as $delivery )
                <tr>
                    <td> {!! $delivery->id !!} </td>
                    <td> {!! $delivery->order->user->name !!} </td>
                    <td> {!! $delivery->order->user->address !!}</td>
                    <td> {!! $delivery->created_at->toFormattedDateString() !!} </td>
                    @if( !$delivery->ship && !$delivery->arrive )
                    <td> <a href="{!! url('staff/delivery/' . $delivery->id . '/ship') !!}" class="warning tiny expanded button"> Ship </a> </td>
                @elseif( $delivery->ship && !$delivery->arrive )

                    <td> <a href="{!! url('staff/delivery/' . $delivery->id . '/arrive') !!}" class="success tiny expanded button"> arrive </a> </td>
                @else
                    <td> <span class="alert label large"> Arrived </span> </td>
                @endif
                </tr>
            @endforeach
        </tbody>
    </table>
 
