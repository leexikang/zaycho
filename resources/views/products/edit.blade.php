@extends('app')
    @section('content')
        {{ Form::model( $product, ['method' => 'PATCH', 'action' => [ "ProductsController@update", $product->id]]  ) }}
        @include('products.form')
        {{ Form::close() }}
    @endsection
