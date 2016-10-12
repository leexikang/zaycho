<div class="row">
    <div class="small-10 small-centered columns order_wrapper">
        <div class="row">

            <div class="small-12 small-centered columns checkout_header">
                <div class="row">
                    <div class="small-10 columns">
                        <small> Order Date </small> 
                        <br/>
                        <small> {!! $order->created_at->toFormattedDateString() !!} </small>
                    </div>

                    @if( $order->valid )
                    <div class="small-2 columns">
                        <br/>
                        <p> <span class="alert label float-right"> Due </span> </p>
                    </div>
                @elseif( !$order->archive )
                        <div class="small-2 columns">
                            <br/>
                            <p> <span class="secondary label float-right"> Pending </span> </p>
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
                            <img src="//placehold.it/100x100">
                        </div>

                    </div>

                    <div class="media-object-section">

                        <h5> 
                            <a href="{!! route('products.show', ['id' => $order->products->first()->id]) !!}">
                                {!! $order->products->first()->name !!} 
                            </a>
                        </h5>
                        <p> <strong> Total: </strong> 
                        {!! $order->products->first()->price * $order->products->first()->pivot->quantity !!} Kyats
                        </p>
                        @if($order->valid)
                        <p> <button class="small button alert expanded "> checkout </button> </p>
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<br/>

