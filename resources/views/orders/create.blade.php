@extends('app')
@section('content')
<div class="row ">
<div class="small-9 small-centered large-6 columns"">
{{ Form::model($product = new \App\Order, ['route' => 'orders.store', 
    'method' => 'POST', 
]) }}
@include('orders.form')
{{ Form::close() }}
</div>
</div>

@endsection
