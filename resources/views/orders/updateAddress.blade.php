@extends('layouts.auth')
@section('content')
    <br/>
    <br/>
<div class="row ">
        

	<div class="small-9 small-centered large-6 columns">

            <div class="callout warning">
                <p>Please update the address, if your current address is not following.</p>
                <p> Note: this will replace the previous address</p>
            </div>

            {{ Form::model( $order->user, ['method' => 'PATCH', 'action' => [ "OrdersController@updateAddress", $order->id ] ]  ) }}
            {{ csrf_field() }}

            <div>
                {{ Form::label('address', 'Address:') }}
                {{ Form::text('address') }}
            </div>
            <div>
                {{ Form::submit('Update', ['class' => 'button expanded']) }}
            </div>
            {{ Form::close() }}


        </div>
</div>

@endsection

