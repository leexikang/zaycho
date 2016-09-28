@extends('app')
@section('content')
    {!! $product->name !!}
    {!! $quantity !!}
   <a href="{!! url('orders/add') !!}" class="btn"> add </a>
@endsection
