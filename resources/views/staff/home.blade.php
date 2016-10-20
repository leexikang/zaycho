@extends('staff.app')
@section('content')
        <div class="small-10 columns">

            <div class="row">
                @include('staff.partials.topOrder')
            </div>

            <div class="row">
                @include('staff.partials.topDeliveries')
            </div>

            <div class="row">
                @include('staff.partials.topPayment')
            </div>

        </div>

@endsection
