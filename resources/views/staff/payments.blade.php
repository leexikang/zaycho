@extends('staff.app')
@section('content')
    <br/>
    <br/>
    <br/>
    <div class="small-10 columns">

        <nav aria-label="You are here:" role="navigation">
            <ul class="breadcrumbs">
            <li><a href="{!! url()->current() !!}"> All </a></li>
            <li><a href="{!! url()->current() . '?by=paid' !!}"> Paid </a></li>
            <li><a href="{!! url()->current() . '?by=unpay' !!}"> Unpaid </a></li>
            </ul>
        </nav>


        @include('staff.partials.paymentsTable')
    </div>
@endsection
