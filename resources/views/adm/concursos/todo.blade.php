@extends('layouts.adm.adm')

@section('titlePage', 'Concursos - Index')

@section('content')

<div class="col-md-10" id="content-wrapper">
    <div class="row">
        <div class="col-lg-12">

            <div class="clearfix">
                <h1 class="pull-left">Concursos à fazer</h1>
            </div>

            @include('adm.elements.alert')

            <div class="row">
                <div class="col-lg-12">
                    @if($concursos->count() <= 0)
                    <div class="alert alert-warning">
                        <i class="fas fa-exclamation-triangle fa-fw fa-lg"></i> Não há bolões de concursos à serem feitos no momento
                    </div>
                    @else
                    <div class="main-box clearfix">
                            <div class="table-responsive">
                                <table class="table customer-list">
                                    <thead>
                                        <tr>
                                            <th><span>Loteria</span></th>
                                            <th><span>Número</span></th>
                                            <th><span>Tipo</span></th>
                                            <th><span>Data do sorteio</span></th>
                                            <th>&nbsp;</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @foreach ($concursos as $concurso)
                                        <tr>
                                            <td>
                                                <a href="{{ route('adm.concursos.edit', [ $concurso->id ]) }}" class="user-link">
                                                    {{ $concurso->lotery->name }}
                                                </a>
                                            </td>
                                            <td>
                                                <a href="{{ route('adm.concursos.edit', [ $concurso->id ]) }}" class="user-link">
                                                    {{ $concurso->number }}
                                                </a>
                                            </td>
                                            <td>
                                                <a href="{{ route('adm.concursos.edit', [ $concurso->id ]) }}" class="user-link">
                                                    {{ $concurso->getType() }}
                                                </a>
                                            </td>
                                            <td>
                                                <a href="{{ route('adm.concursos.edit', [ $concurso->id ]) }}" class="user-link">
                                                    {{ $concurso->getDrawDay() }}
                                                </a>
                                            </td>
                                            <td style="width: 20%;">
                                                <a href="{{ route('adm.concursos.check', [$concurso->id]) }}" class="table-link">
                                                    <span class="fa-stack">
                                                        <i class="fa fa-square fa-stack-2x text-success"></i>
                                                        <i class="fas fa-chevron-circle-right fa-stack-1x fa-inverse"></i>
                                                    </span>
                                                </a>

                                                <a href="{{ route('adm.concursos.edit', [$concurso->id]) }}" class="table-link">
                                                    <span class="fa-stack">
                                                        <i class="fa fa-square fa-stack-2x"></i>
                                                        <i class="fas fa-pen fa-stack-1x fa-inverse"></i>
                                                    </span>
                                                </a>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            {{ $concursos->links() }}
                        </div>
                    @endif
                </div>
            </div>

        </div>
    </div>
</div>

@endsection