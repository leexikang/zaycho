@extends('app')
@section('content')
    <div class="row ">
        <div class="small-9 small-centered large-6 columns"">

            <h4 class="subheader"> Main Photo </h4>

            <form action="/products/{!! $product->id !!}/mainphoto" method="POST" class="dropzone" id="mainPhoto">
            {{ csrf_field() }}
            </form>
            <hr> 
            <h4 class="subheader"> Description Photos </h4>

            <form id="subPhotos" action="/products/{!! $product->id !!}/photos" method="POST" class="dropzone" >
            {{ csrf_field() }}
            </form>
            <br/> <br/>
            <a href="{!! url('products/' . $product->id) !!}" class="button expanded"> Create </a>
        </div>
    </div>

    @endsection
