@extends('layouts.adm.adm')

@section('titlePage', 'Concursos - Check')

@section('content')

<div class="col-md-10" id="content-wrapper">
    <div class="row">
        <div class="col-lg-12">

            <div class="clearfix">
                <h1 class="pull-left"><span class="far fa-star"></span> Apostas do concurso Nº {{ $concurso->number }} da <b>{{ $concurso->lotery->name }}</b></h1>
            </div>

            @include('adm.elements.alert')

            <div class="row">
                <div class="main-box">
                    <div>
                        <strong>Loteria:</strong> {{ $concurso->lotery->name }}
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
                        <a href='{{ route("adm.concursos.check", [$concurso->id]) }}' class='btn btn-primary'>Voltar</a>
                    </div>
                    
                    <h2 class='mt-4'>Apostas</h2>
                    <table class='table table-bordered'>
                        <thead>
                            <tr>
                                <th>ID do Bolao</th>
                                <th>Qt de números</th>
                                <th>Números</th>
                                <th>Premiação</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $totalGames = 0;
                            ?>
                            @foreach($concurso->boloes()->orderBy('prize', 'DESC')->orderBy('id', 'DESC')->get() as $bolao)
                                @foreach($bolao->games()->orderBy('prize', 'DESC')->orderBy('numbers', 'ASC')->get() as $game)
                                    <tr>
                                        <td>{{ $game->bolao_id }}</td>
                                        <td>{{ $game->quantity_numbers }}</td>
                                        <td>{{ $game->numbers }}</td>
                                        <td>{{ $game->getFormattedPrize() }}</td>
                                    </tr>
                                    <?php 
                                    $totalGames++;
                                    ?>
                                @endforeach
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th colspan='2'>Total</th>
                                <td>{{ $totalGames }}</td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection