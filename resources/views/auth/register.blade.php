@extends('layouts.auth')

@section('content')
<br/>
<br/>
<div class="row">
    <div class="small-8 small-centered columns">
        <div class="row">
            <div class="small-8 small-centered columns">
                <h3 class="subheader"> Sign up</3>

                <form class="form-horizontal" role="form" method="post" action="{{ url('/register') }}">
                    {{ csrf_field() }}

                    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                        <label for="name" class="col-md-4 control-label">name</label>

                        <div class="col-md-6">
                            <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required aria-describedby="exampleHelpText">

                            @if ($errors->has('name'))
                                 <small class="error"> {{ $errors->first('name') }} </small>
                            @endif
                        </div>

                    </div>

                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                        <label for="email" class="col-md-4 control-label">e-mail address</label>

                        <div class="col-md-6">
                            <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}">

                            @if ($errors->has('email'))
                                <span class="error"> <small class="error"> {{ $errors->first('email') }} </small>  </span>
                            @endif
                            
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                        <label for="password" class="col-md-4 control-label">password</label>

                        <div class="col-md-6">
                            <input id="password" type="password" class="form-control" name="password">

                            @if ($errors->has('password'))
                                <span class="error"> <small class="error"> {{ $errors->first('password') }} </small> </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                        <label for="password-confirm" class="col-md-4 control-label">confirm password</label>

                        <div class="col-md-6">
                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation">

                            @if ($errors->has('password_confirmation'))
                            <span class="error">
                                <small>{{ $errors->first('password_confirmation') }} </small>
                            </span>
                            @endif
                        </div>
                    </div>
                    <div class="row">

                        <div class="small-12 columns">
                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="expanded alert hollow button">
                                    <i class="fa fa-btn fa-user"></i> Register
                                    </button>
                                </div>
                            </div>
                        </div>

                    </div>

                </form>

            </div>
        </div>
    </div>
</div>
@endsection
