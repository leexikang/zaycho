{{ csrf_field() }}
    <div>
        {{ Form::label('name', 'Name:') }}
        {{ Form::text('name') }}
    </div>

    <div>
        {{ Form::label('price', 'Price:') }}
        {{ Form::text('price') }}
    </div>

    <div>

        {{ Form::label('due_date', 'Due Date:') }}
        {!! Form::text('due_date', $product->due_date->format('Y-m-d')) !!}

    </div>

   <div>

        {{ Form::label('minimun_sale', 'Minimun Sale:') }}
        {{ Form::text('minimun_sale') }}

    </div>

  <div>
        {{ Form::submit('create') }}

    </div>