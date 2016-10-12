@extends('app')

@section('content')
    <br>
    <br>
    <div class="row">

        <ul class="tabs" data-tabs id="example-tabs">
            <li class="tabs-title is-active"><a href="#panel1" aria-selected="true"> Panding </a></li>

            <li class="tabs-title"><a href="#panel2"> History </a></li>
        </ul>

        <div class="tabs-content" data-tabs-content="example-tabs">
            <div class="tabs-panel is-active" id="panel1">

                @foreach( $orders as $order )
                    @include("layouts.ordertab")
               @endforeach
            </div>

            <div class="tabs-panel" id="panel2">
                <h1> History </h1>
                @foreach( $sends as $order )
                    
                    @include("layouts.ordertab")
                   
                @endforeach


            </div>
        </div>

    </div>

@endsection
 
