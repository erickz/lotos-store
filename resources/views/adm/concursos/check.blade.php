@extends('layouts.adm.adm')

@section('titlePage', 'Concursos - Check')

@section('content')

<div class="col-md-10" id="content-wrapper">
    <div class="row">
        <div class="col-lg-12">

            <div class="clearfix">
                <h1 class="pull-left"><span class="far fa-star"></span> Conferir resultados do Concurso</h1>
            </div>

            @include('adm.elements.alert')

            <div class="row">
                <div class="main-box">
                    <div>
                        <strong>Loteria:</strong> <b class='badge badge-{{ $concurso->lotery->getColorClass(false) }}'>{{ $concurso->lotery->name }}</b>
                    </div>
                    <div>
                        <strong>Concurso Nº:</strong> {{ $concurso->number }}
                    </div>
                    <div>
                        <strong>Data do concurso:</strong> {{ $concurso->getDrawDay() }}
                    </div>
                    <div>
                        <strong>Nº de bolões:</strong> {{ $concurso->boloes->count() }}
                    </div>
                    <div class='mt-3'>
                        <a href='{{ route("adm.concursos.edit", [$concurso->id]) }}' class='btn btn-primary'>Voltar</a>
                        <a href='{{ route("adm.concursos.allGames", [$concurso->id]) }}' class='btn btn-success'>Visualizar todos os jogos</a>
                    </div>
                    <div class='mt-3'>
                        <div>
                            <b>1.</b><br />
                            <a href='{{ route("adm.concursos.doCheck", [$concurso->id]) }}' class='btn btn-primary'>{!! $concurso->checked ? '<i class="fas fa-check"></i>' : '' !!} Conferir bolões</a>
                        </div>
                        <div>
                            <b>2.</b><br />
                            <a href='{{ route("adm.concursos.prizeCheck", [$concurso->id]) }}' class='btn btn-primary'>{!! $concurso->prized ? '<i class="fas fa-check"></i>' : '' !!} Premiar bolões</a>
                        </div>
                        <div>
                            <b>3.</b><br />
                            <a href='{{ route("adm.concursos.revenueCheck", [$concurso->id]) }}' class='btn btn-primary'>{!! $concurso->revenued ? '<i class="fas fa-check"></i>' : '' !!} Remunerar Vendas</a>
                        </div>
                    </div>
                    <div class='d-flex mt-5'>
                        <a href='{{ route("adm.concursos.markAllBoloes", [$concurso->id]) }}' class='btn btn-warning'>Marcar bolões como não feitos</a>
                        <!-- <a href='{{ route("adm.concursos.repayAll", [$concurso->id]) }}' class='btn btn-danger'>Reembolsar bolões</a> -->
                    </div>

                    <h2 class='mt-4'>Bolões</h2>
                    <table class='table table-bordered'>
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nome</th>
                                <th>Qtd de jogos premiados</th>
                                <th>Feito</th>
                                <th>Verificado</th>
                                <th>Premiado</th>
                                <th>Reembolsar</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($concurso->boloes()->orderBy('prize', 'DESC')->orderBy('id', 'DESC')->get() as $bolao)
                                <tr>
                                    <td><a href="{{ route('adm.boloes.edit', [$bolao->id]) }}">{{ $bolao->id }}</a></td>
                                    <td><a href="{{ route('adm.boloes.edit', [$bolao->id]) }}">{{ $bolao->name }}</a></td>
                                    <td>{{ $bolao->games()->where('prized', 1)->get()->count() }}</td>
                                    <td>
                                        @if(! $bolao->done)
                                            <span class='badge badge-danger'>Não</span>
                                        @else
                                            <span class='badge badge-success mr-2'><i class="fas fa-check"></i> Sim</span>
                                            <a href='{{ route("adm.concursos.markBoloes", ["id" => $concurso->id, "bolaoId" => $bolao->id]) }}' class='btn btn-warning'>Marcar como não feito</a> 
                                        @endif
                                    </td>
                                    <td>
                                        @if(! $bolao->checked)
                                            <span class='badge badge-danger'>Não</span>
                                        @else
                                            <span class='badge badge-success mr-2'><i class="fas fa-check"></i> Sim</span>
                                        @endif
                                    </td>
                                    <td>
                                        {!! $bolao->prize > 0 ? "<span class='badge badge-success'>Sim:</span> " . $bolao->getFormattedPrize() : "<span class='badge badge-danger'>Não</span>" !!}
                                    </td>
                                    <td>
                                        @if($bolao->repayed)
                                            <span class='badge badge-primary'><i class="fas fa-check"></i> Reembolsado</span>
                                        @else
                                            <a href='{{ route("adm.concursos.repayBolao", ["id" => $concurso->id, "bolaoId" => $bolao->id]) }}' class='btn btn-danger'>Reembolsar</a> 
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection