<table>
    <h4> Payments </h4>
    <thead>
        <tr>
            <th width="50"> ID</th>
            <th width="100"> Name </th>
            <th width="200"> Address </th>
            <th width="150"> Order ID</th>
            <th width="150"> Date </th>

            <th width="50"></th>
        </tr>
    </thead>
    <tbody>
        @foreach( $payments as $payment )
            <tr>
                <td> {!! $payment->id !!} </td>
                <td> {!! $payment->user->name !!} </td>
                <td> {!! $payment->user->address !!} </td>
                <td> {!! $payment->order->id !!} </td>
                <td> {!! $payment->created_at->toFormattedDateString() !!} </td>
                @if( !$payment->pay )
                    <td> <span class="alert label"> Unpay</span> </td>
                @else
                    <td> <span class="secondary label"> Paied </span> </td>
                @endif

            </tr>
        @endforeach
    </tbody>
</table>

