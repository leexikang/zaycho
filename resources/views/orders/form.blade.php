{{ csrf_field() }}
    <div>
        {{ Form::label('archive', 'Archive:') }}
{!! Form::select('archive', ['1' => 'Yes', '0' => 'No'], null, ['placeholder' => 'Chose true or fasle']); !!}
    </div>

    <div>
        {{ Form::label('valid', 'Valid') }}

{!! Form::select('valid', ['1' => 'Yes', '0' => 'No'], null, ['placeholder' => 'Chose true or fasle']); !!}
    </div>

    <div>

        {{ Form::label('user_id', 'User ID:') }}
        {!! Form::text('user_id') !!}

    </div>



  <div>
  {{ Form::submit('create', ['class' => 'button expanded']) }}

    </div>
