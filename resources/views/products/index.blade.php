@extends('app')
    @section('content')
        <h1> Hello </h1>
    @foreach( $products as $product)
    <h2> {{ $product->name }} </h2>
    {{ $product->price }} 

    <a class="hollow button" href="products/{{ $product->id }}/confirm"> Buy </a>
    @endforeach
@endsection
