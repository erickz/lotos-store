@extends('layouts.adm.adm')

@section('titlePage', 'Users - Index')

@section('content')

    <div class="col-md-10" id="content-wrapper">
        <div class="row">
            <div class="col-lg-12">

                <div class="clearfix">
                    <h1 class="pull-left"><span class="fas fa-user-edit"></span> Edit user</h1>
                </div>

                @include('adm.elements.alert')

                <div class="row">
                    <div class="main-box">
                        <form method="post" role="form" action="{{ route('adm.users.update', [$user->id]) }}">
                            @csrf
                            @method('patch')

                            <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                                <label for="exampleInputEmail1">Name</label>
                                <input type="text" name="name" class="form-control" placeholder="Name" value="{{ $user->name }}">
                                <span class="help-block"><i class="icon-remove-sign"></i> {{ $errors->first('name') }}</span>
                            </div>

                            <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
                                <label for="exampleInputEmail1">Email</label>
                                <input type="email" name="email" class="form-control" disabled placeholder="Enter email" value="{{ $user->email }}">
                                <span class="help-block"><i class="icon-remove-sign"></i> {{ $errors->first('email') }}</span>
                            </div>

                            <button type="submit" class="btn btn-lg btn-success">Save</button>
                        </form>
                    </div>
                </div>

                @include('adm.users.permisions')
            </div>
        </div>
    </div>

@endsection