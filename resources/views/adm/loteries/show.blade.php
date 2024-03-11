@extends('layouts.adm.adm')

@section('titlePage', 'Loterias - Exibir')

@section('content')

<div class="col-md-10" id="content-wrapper">
    <div class="row" id="user-profile">
        <div class="col-lg-12">

            <div class="clearfix">
                <h1 class="pull-left"><span class="fas fa-receipt"></span> Exibir loteria</h1>
            </div>

            @include('adm.elements.alert')

            <div class="row profile-user-info">
                <div class="main-box clearfix">
                    <div class="profile-header">
                        <h3 class="mt-0"><span>{{ $lotery->name }}</span></h3>
                    </div>

                    <div class="col-sm-8">
                        <div class="profile-user-details clearfix">
                            <div class="profile-user-details-label">
                                Sigla
                            </div>
                            <div class="profile-user-details-value">
                                {{ $lotery->initials }}
                            </div>
                        </div>
                        <div class="profile-user-details clearfix">
                            <div class="profile-user-details-label">
                                Dias de sorteio
                            </div>
                            <div class="profile-user-details-value">
                                {{ $lotery->getFormatedDrawDays() }}
                            </div>
                        </div>
                        <div class="profile-user-details clearfix">
                            <div class="profile-user-details-label">
                                Descrição
                            </div>
                            <div class="profile-user-details-value">
                                {{ $lotery->description }}
                            </div>
                        </div>
                        <div class="profile-user-details clearfix">
                            <div class="profile-user-details-label">
                                Maior dezena
                            </div>
                            <div class="profile-user-details-value">
                                {{ $lotery->biggest_number }}
                            </div>
                        </div>
                        <div class="profile-user-details clearfix">
                            <div class="profile-user-details-label">
                                Número de jogos por cartela
                            </div>
                            <div class="profile-user-details-value">
                                {{ $lotery->number_games_payslip }}
                            </div>
                        </div>
                        <div class="profile-user-details clearfix">
                            <div class="profile-user-details-label">
                                Mínimo de marcações
                            </div>
                            <div class="profile-user-details-value">
                                {{ $lotery->min_numbers }}
                            </div>
                        </div>
                        <div class="profile-user-details clearfix">
                            <div class="profile-user-details-label">
                                Máximo de marcações
                            </div>
                            <div class="profile-user-details-value">
                                {{ $lotery->max_numbers }}
                            </div>
                        </div>
                        <div class="profile-user-details clearfix">
                            <div class="profile-user-details-label">
                                Mínimo de acertos
                            </div>
                            <div class="profile-user-details-value">
                                {{ $lotery->min_match }}
                            </div>
                        </div>
                        <div class="profile-user-details clearfix">
                            <div class="profile-user-details-label">
                                Máximo de acertos
                            </div>
                            <div class="profile-user-details-value">
                                {{ $lotery->max_match }}
                            </div>
                        </div>
                    </div>
                </div>
            </div><!-- /user-profile -->

            @if ($lotery->costs->isNotEmpty())
                <div class="col-lg-6">
                    <div class="main-box clearfix">
                        <h2>Valor das apostas</h2>
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead>
                                <tr>
                                    @if ($lotery->initials == 'LC')
                                        <th><span>Duplos</span></th>
                                        <th><span>Triplos</span></th>
                                    @endif
                                    <th><span>Números</span></th>
                                    <th><span>Preço</span></th>
                                </tr>
                                </thead>
                                <tbody>
                                    {{-- Having an if before the foreach will improve the performance --}}
                                    @if ($lotery->initials == 'LC')
                                        @foreach($lotery->costs as $cost)
                                            <tr>
                                                <td>{{ $cost->double }}</td>
                                                <td>{{ $cost->triple }}</td>
                                                <td>{{ $cost->number_matches }}</td>
                                                <td>{{ $cost->getPrize() }}</td>
                                            </tr>
                                        @endforeach
                                    @else
                                        @foreach($lotery->costs as $cost)
                                            <tr>
                                                <td>{{ $cost->number_matches }}</td>
                                                <td>{{ $cost->getPrice('prize') }}</td>
                                            </tr>
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>

@endsection