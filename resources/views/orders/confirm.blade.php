@extends('app')
@section('content')
    {!! $product->name !!}
    {!! $quantity !!}
    {!! Form::open(['url' => 'orders/add', 'method' => 'post']) !!}
    <input type="hidden" name="product" id="product" value="{!! $product->id !!}" >
    <input type="hidden" name="quantity" id="quantity" value="{!! $quantity !!}">
    <input type="submit" name="add" value="add">
    {!! Form::close() !!}
@endsection
