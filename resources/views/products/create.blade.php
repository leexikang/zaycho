@extends('app')
@section('content')
<div class="row ">
<div class="small-9 small-centered large-6 columns"">
		{{ Form::model($product = new \App\Product, ['route' => 'products.store', 'method' => 'POST']) }}
		@include('products.form')
		{{ Form::close() }}
	</div>
</div>
@endsection
