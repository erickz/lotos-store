@extends('layouts.adm.adm')

@section('titlePage', 'Users - Create')

@section('content')

    <div class="col-md-10" id="content-wrapper">
        <div class="row">
            <div class="col-lg-12">

                <div class="clearfix">
                    <h1 class="pull-left"><span class="fas fa-user-plus"></span> Add user</h1>
                </div>

                <div class="row">
                    <div class="main-box">
                        <form method="post" role="form" action="{{ route('adm.users.store') }}">
                            @csrf

                            <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                                <label for="exampleInputEmail1">Name</label>
                                <input type="text" name="name" class="form-control" placeholder="Name" value="{{ old('name') }}">
                                <span class="help-block"><i class="icon-remove-sign"></i> {{ $errors->first('name') }}</span>
                            </div>

                            <div class="form-group form-group-select2">
                                <label>Role</label>
                                <select name="roles[]" class="select2 form-control" multiple="multiple">
                                    @foreach($roles as $role)
                                        <option value="{{ $role->id }}" {{ in_array($role->id, old('roles')) ? 'selected="selected"' : '' }}>{{ $role->display_name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
                                <label for="exampleInputEmail1">Email</label>
                                <input type="email" name="email" class="form-control" placeholder="Enter email" value="{{ old('email') }}">
                                <span class="help-block"><i class="icon-remove-sign"></i> {{ $errors->first('email') }}</span>
                            </div>

                            <div class="form-group {{ $errors->has('password') ? 'has-error' : '' }}">
                                <label for="exampleInputPassword1">Password</label>
                                <input type="password" name="password" class="form-control pwstrength" placeholder="Password" data-indicator="pwindicator" >
                                <span class="help-block"><i class="icon-remove-sign"></i> {{ $errors->first('password') }}</span>
                                <div id='pwindicator' class="pwdindicator">
                                    <div class="bar"></div>
                                    <div class="pwdstrength-label"></div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="exampleInputPassword1">Confirm password</label>
                                <input type="password" name="password_confirmation" class="form-control" placeholder="Password">
                            </div>

                            <button type="submit" class="btn btn-lg btn-success">Save</button>
                        </form>
                    </div>
                </div>


            </div>
        </div>
    </div>

@endsection