@extends('staff.app')
@section('content')
    <br/>
    <br/>
    <br/>
    <div class="small-10 columns">
        <a href='/orders/create' class="button"> Create new orders </a>
       <nav aria-label="You are here:" role="navigation">
           <ul class="breadcrumbs">
               <li><a href="{!! url()->current() . "?by=success" !!}"> Success </a></li>
               <li><a href="{!! url()->current() . "?by=fail" !!}"> Fail</a></li>
               <li><a href="{!! url()->current() . "?by=pending" !!}"> Pending</a></li>
           </ul>
       </nav>


        @include('staff.partials.ordersTable')
    </div>
@endsection
