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
                <td> {!! $payment->order->user->name !!} </td>
                <td> {!! $payment->order->user->address !!} </td>
                <td> {!! $payment->order->id !!} </td>
                <td> {!! $payment->created_at->toFormattedDateString() !!} </td>
                @if( !$payment->pay )
                    <td> <a class="alert tiny button" href="{!! url('staff/payment/'. $payment->id .'/pay') !!}"> Paid </a> </td>
                @else
                    <td> <span class="success label"> Paid </span> </td>
                @endif

            </tr>
        @endforeach
    </tbody>
</table>
