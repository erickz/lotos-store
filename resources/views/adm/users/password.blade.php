@extends('layouts.adm.adm')

@section('titlePage', 'Users - Edit')

@section('content')

    <div class="col-md-10" id="content-wrapper">
        <div class="row">
            <div class="col-lg-12">

                <div class="clearfix">
                    <h1 class="pull-left"><span class="fas fa-user-edit"></span> Edit user's password</h1>
                </div>

                @include('adm.elements.alert')

                <div class="row">
                    <div class="main-box">
                        <form method="post" role="form" action="{{ route('adm.users.updatePassword', [$user->id]) }}">
                            @csrf
                            @method('patch')

                            <div class="form-group">
                                <label for="exampleInputEmail1">Name</label>
                                <input type="text" disabled name="name" class="form-control" placeholder="Name" value="{{ $user->name }}">
                                <span class="help-block"><i class="icon-remove-sign"></i> {{ $errors->first('name') }}</span>
                            </div>

                            <div class="form-group {{ $errors->has('password') ? 'has-error' : '' }}">
                                <label for="password">Password</label>
                                <input type="password" name="password" class="form-control pwstrength" placeholder="Enter password" data-indicator="pwindicator" />
                                <span class="help-block"><i class="icon-remove-sign"></i> {{ $errors->first('password') }}</span>
                                <div id='pwindicator' class="pwdindicator">
                                    <div class="bar"></div>
                                    <div class="pwdstrength-label"></div>
                                </div>
                            </div>

                            <div class="form-group {{ $errors->has('password_confirmation') ? 'has-error' : '' }}">
                                <label for="exampleInputEmail1">Password confirmation</label>
                                <input type="password" name="password_confirmation" class="form-control" placeholder="Password Confirmation" value="">
                                <span class="help-block"><i class="icon-remove-sign"></i> {{ $errors->first('password_confirmation') }}</span>
                            </div>

                            <button type="submit" class="btn btn-lg btn-success">Save</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection