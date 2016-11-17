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

        {{ Form::label('category', 'category_id') }}
        {!! Form::select('category_id', $categories, null, ['placeholder' => 'Choose a category']); !!}

    </div>

    <div>

        {{ Form::label('supplier', 'supplier_id') }}
        {!! Form::select('supplier_id', $suppliers, null, ['placeholder' => 'Choose a supplier']); !!}

    </div>


    <div>

        {{ Form::label('minimun_sale', 'Minimun Sale:') }}
        {{ Form::text('minimun_sale') }}

    </div>
    <div>

    </div>


  <div>
  {{ Form::submit('create', ['class' => 'button expanded']) }}

    </div>
