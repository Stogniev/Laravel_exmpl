@extends('layouts.app')

@section('content')
    <body class="login_page">
    <div class="login-wrapper">
        <div id="login" class="login loginpage col-lg-offset-4 col-lg-4 col-md-offset-3 col-md-6 col-sm-offset-3 col-sm-6 col-xs-offset-0 col-xs-12">
            <h1><a href="#" title="Login Page" tabindex="-1">Ultra Admin</a></h1>

            <form name="loginform" id="loginform" action="{{ url('auth/login') }}" method="post">
                {{ csrf_field() }}
                <p>
                    <label for="user_login">Email<br />
                        <input  id="email" type="email" name="email" class="input" value="{{ old('email') }}"  required autofocus></label>
                    @if ($errors->has('email'))
                        <span class="help-block">
                            <strong style="color: #ff0000;">{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                </p>
                <p>
                    <label for="user_pass">Password<br />
                        <input type="password"  id="password" class="input" name="password"  required></label>
                    @if ($errors->has('password'))
                        <span class="help-block">
                                        <strong style="color: #ff0000;">{{ $errors->first('password') }}</strong>
                                    </span>
                    @endif
                </p>
                <p class="forgetmenot">
                    <label class="icheck-label form-label" for="rememberme"><input name="rememberme" type="checkbox" id="rememberme" value="forever" class="skin-square-orange" checked> Remember me</label>
                </p>
                <p class="submit">
                    <input type="submit" name="wp-submit" id="wp-submit" class="btn btn-orange btn-block" value="Sign In" />
                </p>


            </form>

            <p id="nav">
                <a class="fb" href="{{ url('auth/redirect') }}"><button type="button" class="btn btn-primary facebook"><i class="fa fa-facebook"></i></button></a>
                <a class="tw" href="javascript:void(0)"><button type="button" class="btn btn-primary twitter" style="filter: opacity(.5);"><i class="fa fa-twitter"></i></button></a>
                <a class="vim" href="javascript:void(0)"><button type="button" class="btn btn-primary vimeo" style="filter: opacity(.5);"><i class="fa fa-vimeo-square"></i></button></a>
                <a class="pull-left" href="{{ url('password/reset') }}" title="Password Lost and Found">Forgot password?</a>
                <a class="pull-right" href="{{ url('auth/register') }}" title="Sign Up">Sign Up</a>
            </p>


        </div>
    </div>


@endsection