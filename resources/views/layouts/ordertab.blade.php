<div class="row">
    <div class="small-10 small-centered columns order_wrapper">
        <div class="row">

            <div class="small-12 small-centered columns checkout_header">
                <div class="row">
                    <div class="small-10 columns">
                        <small> Due Date </small> 
                        <br/>
                        <small> {!! $order->products()->first()->due_date->toFormattedDateString() !!} </small>
                        <small> {!! $order->id !!} </small>
                    </div>
            @if( !$order->products()->first()->expired() )
                    
                    @if( $order->products()->first()->due() && !$order->checkout() )
                        <div class="small-2 columns">
                            <br/>
                           
                            <p> <span class="alert label float-right"> Due </span> </p>
                        </div>
                    @elseif($order->checkout() )
                        <div class="small-2 columns">
                            <br/>
                            <p> <span class="success label float-right"> Success </span> </p>
                        </div>
                    @else
                        <div class="small-2 columns">
                            <br/>
                            <p> <span class="warning label float-right"> Pending</span> </p>
                        </div>
                    @endif
                @else
                    <div class="small-2 columns">
                        <br/>
                        <p> <span class="secondary label float-right"> Expired </span> </p>
                    </div>

            @endif
                </div>
            </div>
        </div>
        <br/>
        <div class="row">

            <div class="small-10 small-centered columns">
                <div class="media-object">
                    <div class="media-object-section">

                        <div class="thumbnail">
                        <img src="/{!! $order->products->first()->photos->where('main', 1)->first()->thumbnail_path !!}">
                        </div>

                    </div>

                    <div class="media-object-section">

                        <h5> 

                            <a href="{!! route('products.show', ['id' => $order->products->first()['id']]) !!}">
                            <a href="{!! url('products/' . $order->products->first()['id']) !!}">
                                {!! $order->products->first()['name'] !!} 
                            </a>
                        </h5>
                        <p> <strong> Total: </strong> 
                        {!! $order->products->first()['price'] * $order->products->first()['pivot']['quantity'] !!} Kyats
                        </p>
                        @if($order->products->first()->due() && !$order->checkout())
                            <p> <a class="button alert expanded " href="{!! route('checkout', ['id' => $order->id]) !!}"> checkout </a> </p>
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<br/>
