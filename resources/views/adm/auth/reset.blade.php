@extends('layouts.adm.logged-out')

@section('titlePage', 'Reset Password')

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

                        <h2 class="titleResetPassword">Reset your password</h2>

                        @include('adm.auth.alert-for-auth')

                        <form name="loginForm" method="POST" role="form" action="{{ route('adm.auth.doReset', ['token' => $token]) }}">
                            @csrf
                            <input type="hidden" name="email" value="{{ $email }}" />
                            <input type="hidden" name="token" value="{{ $token }}" />

                            <div class="input-group input-group-lg {{ $errors->has('password') ? 'has-error' : '' }}">
                                <span class="input-group-addon"><i class="fa fa-key"></i></span>
                                <input type="password" name="password" class="form-control {{ $errors->has('password') ? 'has-error' : '' }}" placeholder="Password">
                            </div>
                            <div class="input-group input-group-lg {{ $errors->has('password') ? 'has-error' : '' }}">
                                <span class="input-group-addon"><i class="fa fa-unlock"></i></span>
                                <input type="password" name="password_confirmation" class="form-control {{ $errors->has('password') ? 'has-error' : '' }}" placeholder="Password Confirmation">
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <a href="{{ route('adm.auth.index') }}" class="btn btn-primary col-xs-4">Back to Login</a>

                                        <button type="submit" class="btn btn-success col-md-offset-3 col-xs-5">Reset Password</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
