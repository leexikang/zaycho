@extends('app')

@section('content')

    <br/>

    <div class="expended rows">

        @include("partials.subnav")

        <div class="columns large-10">
            @foreach( $products->chunk(3) as $product)

                <div class="row small-up-2 large-up-3">
                    @foreach( $product as $item )
                        <div class="columns">
                            <img class="thumbnail" src="/{!! $item->photos->where('main', 1)->first()->path !!}">
                            <h3> {{ $item->name }} </h3>
                            <p> Price: K{{ $item->price }} </p>
                            <p> Minimal Sale: {{ $item->minimun_sale }} </p>
                            <p> Bought {{ $item->bought }} </p>
                            <p> Expire Date {{ $item->due_date->format('Y-m-d') }} </p>

                            <a class="success expanded button" href="{!! url('products',$item->id ) !!}"> See More</a>
                        </div>
                    @endforeach
                </div>
                <br/>
            @endforeach
        </div>
    </div>
    <hr/>
@endsection
