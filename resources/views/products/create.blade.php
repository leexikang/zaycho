@extends('app')
 @section('content')
    {{ Form::model($product = new \App\Product, ['route' => 'products.store', 'method' => 'POST']) }}
     @include('products.form');
     {{ Form::close() }}
 @endsection
