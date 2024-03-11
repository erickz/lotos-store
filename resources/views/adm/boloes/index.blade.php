@extends('layouts.adm.adm')

@section('titlePage', 'Boloes - Index')

@section('content')

<div class="col-md-10" id="content-wrapper">
    <div class="row">
        <div class="col-lg-12">

            <div class="clearfix">
                <h1 class="pull-left"><i class="fas fa-newspaper"></i> Bolões</h1>

                <div class="pull-right top-page-ui">
                    @if (auth()->user()->can('create-boloes'))
                    <a href="{{ route('adm.boloes.create') }}" class="btn btn-primary pull-right">
                        <i class="fas fa-plus-circle"></i> Add bolão
                    </a>
                    @endif
                </div>
            </div>

            @include('adm.elements.alert')

            <div class="row">
                <div class="col-lg-12">
                    @if($boloes->count() <= 0)
                    <div class="alert alert-warning">
                        <i class="fas fa-exclamation-triangle fa-fw fa-lg"></i> Não há bolões à serem exibidos
                    </div>
                    @else
                        @include('adm.boloes.listing')
                    @endif
                </div>
            </div>

        </div>
    </div>
</div>

@endsection