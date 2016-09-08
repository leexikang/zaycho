@extends('app')
@section('content')
<div class="row ">
	<div class="small-9 small-centered large-6 columns">

		{{ Form::model( $product, ['method' => 'PATCH', 'action' => [ "ProductsController@update", $product->id] ]  ) }}
		@include('products.form')
		{{ Form::close() }}

	</div>
</div>

@endsection
