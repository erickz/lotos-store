@extends('layouts.adm.adm')

@section('titlePage', 'Users - Index')

@section('content')

<div class="col-md-10" id="content-wrapper">
    <div class="row">
        <div class="col-lg-12">

            <div class="clearfix">
                <h1 class="pull-left">Users</h1>

                <div class="pull-right top-page-ui">
                    @if (auth()->user()->can('create-users'))
                        <a href="{{ route('adm.users.create') }}" class="btn btn-primary pull-right">
                            <i class="fas fa-user-plus fa-lg"></i> Add user
                        </a>
                    @endif
                </div>
            </div>

            @include('adm.elements.alert')

            <div class="row">
                <div class="col-lg-12">
                    @if($users->count() <= 0)
                        <div class="alert alert-warning">
                            <i class="fas fa-exclamation-triangle fa-fw fa-lg"></i> There are no users to display
                        </div>
                    @else
                        @include('adm.users.listing')
                    @endif
                </div>
            </div>


        </div>
    </div>
</div>

@endsection