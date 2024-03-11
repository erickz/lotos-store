@extends('layouts.adm.logged-out')

@section('titlePage', 'Login')

@section('content')
    <div class="col-xs-12">
        <div id="login-box">
            <div class="row">
                <div class="col-xs-12 clearfix" id="login-box-header">
                    <div class="login-box-header-red"></div>
                    <div class="login-box-header-green"></div>
                    <div class="login-box-header-yellow"></div>
                    <div class="login-box-header-purple"></div>
                    <div class="login-box-header-blue"></div>
                    <div class="login-box-header-gray"></div>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12">
                    <div id="login-box-inner">
                        <!-- <img src="img/logo-login.png" alt="SuperheroAdmin" class="img-responsive" id="login-logo"/> -->
                        <div id="login-logo">
                            <img src="{{ asset('img/logo-login.png') }}" alt=""/> LotosOnline
                        </div>

                        @include('adm.auth.alert-for-auth')

                        <form name="loginForm" method="POST" role="form" action="{{ route('adm.auth.doLogin') }}">
                            @csrf
                            <div class="input-group input-group-lg {{ $errors->has('email') ? 'has-error' : '' }}">
                                <span class="input-group-addon"><i class="fas fa-user"></i></span>
                                <input class="form-control" name="email" type="text" value="{{ old('email') }}" placeholder="Email address" autofocus>
                            </div>
                            <div class="input-group input-group-lg {{ $errors->has('password') ? 'has-error' : '' }}">
                                <span class="input-group-addon"><i class="fa fa-key"></i></span>
                                <input type="password" name="password" class="form-control {{ $errors->has('password') ? 'has-error' : '' }}" placeholder="Password">
                            </div>
                            <div class="form-group">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember me
                                    </label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6 col-xs-12 col-sm-push-6">
                                    <button type="submit" class="btn btn-success col-xs-12">Login</button>
                                </div>
                                <a href="{{ route('adm.auth.recover') }}" id="login-forget-link" class="col-sm-6 col-xs-12 col-sm-pull-6">
                                    Did you forget your password?
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection