@extends('layouts.auth')
@section('content')
    <br/>
    <br/>
<div class="row ">
	<div class="small-9 small-centered large-6 columns">

		{{ Form::model( $user, ['method' => 'PATCH', 'action' => [ "UsersController@update", $user->id ] ]  ) }}
		@include('users.form')
		{{ Form::close() }}
            

	</div>
</div>

@endsection
