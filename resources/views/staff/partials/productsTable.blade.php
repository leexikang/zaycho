    <table>
        <h4> Products </h4>
        <thead>
            <tr>
                <th width="30"> Id</th>
                <th width="300"> Name </th>
                <th width="100"> Category </th>
                <th width="50"> Bought </th>
                <th width="50"> Sold </th>
                <th width="200"> Vendor </th>
                <th width="50"></th>
                <th width="50"></th>
            </tr>
        </thead>
        <tbody>
            @foreach( $products as $product )
                <tr>
                    <td> {!!$id =  $product->id !!} </td>
                    <td> <a href="{!! url('products/'. $product->id) !!}"> {!! $product->name !!} </a> 
                    </td>
                    <td> {!! $product->category->name !!} </td>
                    <td> {!! $product->bought !!} </td>
                    <td> {!! $product->minimun_sale!!} </td>
                    <td> {!! $product->supplier->name !!} </td>
                    <td> <a href="{!! url('products/'. $id . '/edit') !!}" class="warning button tiny"> Edit </a> </td>
                    <td> 

                    {!! Form::open(['method' => 'DELETE', 'route' => ['products.destroy', $id]]) !!}
                    {{ csrf_field() }}
                        <button class="alert button tiny"> DELETE </a> 
                    {!! Form::close() !!}
                    </td>


                </tr>
            @endforeach
        </tbody>
    </table>
 
