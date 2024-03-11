@extends('layouts.adm.adm')

@section('titlePage', 'Customers - Index')

@section('content')

<div class="col-md-10" id="content-wrapper">
    <div class="row">
        <div class="col-lg-12">

            <div class="clearfix">
                <h1 class="pull-left">Customers</h1>

                <div class="pull-right top-page-ui">
                    <a href="{{ route('adm.customers.create') }}" class="btn btn-primary pull-right">
                        <i class="fas fa-user-plus fa-lg"></i> Add customer
                    </a>
                </div>
            </div>

            @include('adm.elements.alert')

            <div class="row">
                <div class="col-lg-12">
                    @if($customers->count() <= 0)
                        <div class="alert alert-warning">
                            <i class="fas fa-exclamation-triangle fa-fw fa-lg"></i> There are no customers to display
                        </div>
                    @else
                        @include('adm.customers.listing')
                    @endif
                </div>
            </div>

        </div>
    </div>
</div>

@endsection