{{ csrf_field() }}
    <div>
        {{ Form::label('name', 'Name:') }}
        {{ Form::text('name') }}
    </div>

    <div>
        {{ Form::label('address', 'Address:') }}
        {{ Form::text('address') }}
    </div>

    <div>
  {{ Form::submit('create', ['class' => 'button expanded']) }}
    </div>
