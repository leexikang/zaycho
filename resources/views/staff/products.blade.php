@extends('staff.app')
@section('content')
    <br/>
    <br/>
    <br/>

    <div class="small-10 columns">
        <a class="button" href="/products/create"> Create New Product  </a> 
        <br/>

        <nav aria-label="You are here:" role="navigation">
            <ul class="breadcrumbs">
            <li><a href="{!! url()->current() !!}">Ascending</a></li>
            <li><a href="{!! url()->current() . "?by=desc" !!}">Descending</a></li>
            </ul>
        </nav>

        @include('staff.partials.productsTable')
    </div>
@endsection
