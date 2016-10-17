@extends('layouts.auth')

@section('content')

    <br/>
    <br/>
    <br/>
    <div class="row">

        <div class="small-6 small-centered columns login-form-background login-form-wrapper"> 

            <div class="row">

                <div class="small-8 small-centered columns ">
                <br/> 
                </div>
            </div>

            <div class="row">
            <div class="small-8 small-centered columns">

                <form class="form-horizontal" role="form" method="POST" action="{{ url('/staff/login') }}">

                    {{ csrf_field() }}
                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                        <label for="email">E-Mail Address</label>

                        <div class="col-md-6">
                            <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}">

                            @if ($errors->has('email'))
                            <span class="error">
                                <small> {{ $errors->first('email') }} </small>
                            </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                        <label for="password">Password</label>

                        <div class="col-md-6">
                            <input id="password" type="password" class="form-control" name="password">

                            @if ($errors->has('password'))
                            <span class="error">
                                <small> {{ $errors->first('password') }} </small>
                            </span>
                            @endif
                        </div>
                    </div>

                    <div class="row">
                        <div class="small-6 columns">
                            <div class="form-group">
                                <input type="checkbox" name="remember"> Remember Me
                            </div>
                            
                        </div>

                        <div class="small-6 columns">
                            <a class="btn btn-link" href="{{ url('/password/reset') }}">Forgot Your Password?</a>
                        </div>

                    </div>

                    <div class="row">
                        <div class="form-group">
                            <div class="small-12 columns">
                                <button type="submit" class="expanded hollow button">
                                    <i class="fa fa-btn fa-sign-in"></i> Login
                                </button>

                            </div>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>

</div>
</div>
@endsection
