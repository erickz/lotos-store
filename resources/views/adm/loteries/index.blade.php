@extends('layouts.adm.adm')

@section('titlePage', 'Loterias - Listar')

@section('content')

<div class="col-md-10" id="content-wrapper">
    <div class="row">
        <div class="col-lg-12">

            <div class="clearfix">
                <h1 class="pull-left">Loterias</h1>
            </div>

            @include('adm.elements.alert')

            <div class="row">
                <div class="col-lg-12">
                    @if($loteries->count() <= 0)
                    <div class="alert alert-warning">
                        <i class="fas fa-exclamation-triangle fa-fw fa-lg"></i> Não há loterias à exibir
                    </div>
                    @else
                        @include('adm.loteries.listing')
                    @endif
                </div>
            </div>

        </div>
    </div>
</div>

@endsection