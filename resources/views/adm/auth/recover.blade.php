@extends('layouts.adm.logged-out')

@section('titlePage', 'Recover Password')

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

                        @if ($errors->has('email'))
                            <div class="alert alert-warning">
                                {!! $errors->has('email') ? $errors->first('email') . "<br />" : ''  !!}
                            </div>
                        @endif

                        <h2 class="titleResetPassword">Recover your password</h2>

                        @include('layouts.adm.includes.alert')

                        <form name="loginForm" method="POST" role="form" action="{{ route('adm.auth.sendRecovery') }}">
                            @csrf
                            <div class="input-group input-group-lg {{ $errors->has('email') ? 'has-error' : '' }}">
                                <span class="input-group-addon"><i class="fas fa-at"></i></span>
                                <input class="form-control" name="email" type="text" value="{{ old('email') }}" placeholder="Type your email" autofocus>
                            </div>
                            <div class="row">
                                @if (session()->has('message'))
                                    <div class="col-sm-12">
                                        <a href="{{ route('adm.auth.index') }}" class="btn btn-primary col-xs-4">Back to Login</a>

                                        <button type="submit" class="btn btn-success col-md-offset-3 col-xs-5">Send recover link</button>
                                    </div>
                                @else
                                    <div class="col-sm-6 col-xs-12 col-sm-push-6">
                                        <button type="submit" class="btn btn-success col-xs-12">Send recover link</button>
                                    </div>
                                @endif
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection