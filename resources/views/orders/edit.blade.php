@extends('app')
@section('content')
<div class="row ">
	<div class="small-9 small-centered large-6 columns">

		{{ Form::model( $order, ['method' => 'PATCH', 'action' => [ "OrdersController@update", $order->id ] ]  ) }}
		@include('orders.form')
		{{ Form::close() }}
            

	</div>
</div>

@endsection
