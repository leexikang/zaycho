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
                    <td> <a href="#" class="warning tiny expanded button"> Ship </a> </td>
                </tr>
            @endforeach
        </tbody>
    </table>
 
