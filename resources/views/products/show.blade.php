@extends('app')

@section('content')
    <br>
    <div class="row">
        <div class="columns large-6 medium-6">
        <img class="thumbnail" src="/{!! $product->photos->where('main', 1)->first()->path !!}">
        </div>
        <div class="columns large-5 medium-6">

            <h3> {{ $product->name }} </h3>
            <h4> Price: {{ $product->price }}Kyats </h4>
            <p> Minimun Sale: {{ $product->minimun_sale }} </p>
            <p> Bought: {{ $product->bought }} </p>

            {!! Form::open(['url' => 'orders/confirm', 'method' => 'post']) !!}

            <div class="row">
                <div class="columns small-3">
                    <label for="quantity" class="middle"> Quantity: </label>
                </div>
                <input type="hidden" name="product" id="product" value="{!! $product->id !!}">
                <div class="columns small-9">
                    <input type="text" name="quantity" id="quantity" value="1">
                </div>

            </div>
            <div class="row">
                <input  type="submit" class="button large expanded centered" value="Buy">
            </div>
            {!! Form::close() !!}
        </div>
    </div>

    <div class="columns row">
        <ul class="tabs" data-tabs id="example-tabs">
            <li class="tabs-title is-active"><a href="#panel1" aria-selected="true">Tab 1</a></li>
            <li class="tabs-title"><a href="#panel2">Tab 2</a></li>
        </ul>

        <div class="tabs-content" data-tabs-content="example-tabs">
            <div class="tabs-panel is-active" id="panel1">
                <div class="row">
                    <div class="small-8 small-centered columns">
                        @foreach( $product->photos as $photo )
                            <img class="thumbnail center" src="/{!! $photo->path !!}">
                    @endforeach

                    </div>
                </div>
            </div>
            <div class="tabs-panel" id="panel2">
            </div>
        </div>
    </div>
@endsection
