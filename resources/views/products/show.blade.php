@extends('app')

@section('content')
        {{ $product->name }}
        {{ $product->price }}
        {{ $product->signup}}
        {{ $product->bought }}
        {{ $product->due_date }}
@endsection
