@extends('staff.app')
@section('content')
    <br/>
    <br/>
    <br/>
    <div class="small-10 columns">
        <nav aria-label="You are here:" role="navigation">
            <ul class="breadcrumbs">
            <li><a href="{!! url()->current() !!}"> All </a></li>
            <li><a href="{!! url()->current() . '?by=shipped' !!}"> Shipped </a></li>
            <li><a href="{!! url()->current() . '?by=unship' !!}"> Unship</a></li>
            <li><a href="{!! url()->current() . '?by=arrived' !!}"> Arrived </a></li>
            </ul>
        </nav>


        @include('staff.partials.deliveriesTable')
    </div>
@endsection
