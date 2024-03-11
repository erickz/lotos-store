@extends('layouts.adm.adm')

@section('titlePage', 'Concursos - Index')

@section('content')

<div class="col-md-10" id="content-wrapper">
    <div class="row">
        <div class="col-lg-12">

            <div class="clearfix">
                <h1 class="pull-left">Concursos</h1>

                <div class="pull-right top-page-ui">
                    <a href="{{ route('adm.concursos.create') }}" class="btn btn-primary pull-right">
                        <i class="fas fa-plus-circle fa-lg"></i> Add concurso
                    </a>
                </div>
            </div>

            <div class="main-box">
                <h2 class="pl-2">Filtros</h2>

                <form method='GET' action='{{ route("adm.concursos.index") }}'>
                    <div class='clearfix'>
                        <a href='{{ route("adm.concursos.index", ["from" => \Carbon\Carbon::now()->subDays(7)->startOfWeek()->format("d/m/Y"), "to" => \Carbon\Carbon::now()->subDays(7)->endOfWeek()->format("d/m/Y") ]) }}' class='badge badge-success'>De semana passada</a>
                        <a href='{{ route("adm.concursos.index", ["from" => \Carbon\Carbon::now()->startOfWeek()->format("d/m/Y"), "to" => \Carbon\Carbon::now()->endOfWeek()->format("d/m/Y") ]) }}' class='badge badge-success'>Dessa semana</a>
                        <a href='{{ route("adm.concursos.index", ["from" => \Carbon\Carbon::now()->startOfMonth()->format("d/m/Y"), "to" => \Carbon\Carbon::now()->endOfMonth()->format("d/m/Y") ]) }}' class='badge badge-success'>Desse mês</a>
                        <a href='{{ route("adm.concursos.index", ["from" => \Carbon\Carbon::now()->format("d/m/Y"), "to" => \Carbon\Carbon::now()->format("d/m/Y") ]) }}' class='badge badge-success'>De hoje</a>
                    </div>
                    <div class='clearfix'>
                        <div class='pull-left form-group mr-2'>
                            <label>De:</label>
                            <div class='inputHolder'>
                                <input type='text' name='from' class='form-control datepicker' value='{{ request()->get("from") }}' />
                            </div>
                        </div>
                        <div class='pull-left form-group'>
                            <label>Até:</label>
                            <div class='inputHolder'>
                                <input type='text' name='to' class='form-control datepicker' value='{{ request()->get("to") }}' />
                            </div>
                        </div>
                    </div>
                    <div class=''>
                        <button type='submit' class='btn btn-info'>Filtrar</button>
                        <a href='{{ route("adm.concursos.index") }}' class='btn btn-warning'>Resetar Filtro</a>
                    </div>
                </form>
            </div>

            @include('adm.elements.alert')

            <div class="row">
                <div class="col-lg-12">
                    @if($concursos->count() <= 0)
                    <div class="alert alert-warning">
                        <i class="fas fa-exclamation-triangle fa-fw fa-lg"></i> Não há concursos a serem exibidos
                    </div>
                    @else
                        @include('adm.concursos.listing')
                    @endif
                </div>
            </div>

        </div>
    </div>
</div>

@endsection