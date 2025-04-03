@extends('layouts.web.web')

@section('titlePage', 'Meus Bolões | ' . env('APP_NAME'))
@section('descriptionPage', 'Acesse sua conta para ver o seu histórico de bolões.')

@section('content')

@include('web.customers.register_modal')
@include('web.customers.login_modal')

<!--begin::Entry-->
<div class="d-flex flex-column-fluid mt-5" id='user-profile'>
    <!--begin::Container-->
    <div class="container">
        <div class="col-lg-12">
            <div class="main-box clearfix">
                <h1 class='ps-0 mb-8 text-primary'><b>Meus Bolões</b></h1>

                {{-- @include('web.customers.menu') --}}
                
                <div class="row mt-5 mybets">
                    @include('web.includes.alert')

                    <div class='col-lg-12 px-4'>
                        <div class='d-flex align-items-left'>
                            {{-- @if($boloes->count() > 0)
                                <a href='{{ route("web.boloes.customer", [ auth()->guard("web")->user()->id ]) }}' class="btn btn-info mt-2 mb-2 me-2 previewBoloesPage">
                                    <strong>
                                        <!-- <i class='fas fa-share'></i>  -->
                                        Compartilhar Bolões
                                    </strong>
                                </a>
                            @endif --}}
                            <a href="{{ route('web.boloes.create') }}" class="{{ $boloes->count() <= 0 ? 'ms-auto' : '' }} mt-2 mb-2 me-2 btn btn-success createBolao"><strong>+ Criar Bolão</strong></a>
                        </div>
                        
                        <div class='b-table mt-3'>
                            <div class='bg-white rounded table-responsive-lg table-wrapper has-mobile-cards'>
                                <table class='table table-white is-fullwidth is-striped is-hoverable text-center'>
                                    <thead>
                                        <tr>
                                            <!-- <td>#</td> -->
                                            <td>Loteria</td>
                                            <td>Concurso</td>
                                            <td>Cotas</td>
                                            <td>Preço</td>
                                            <td>Status</td>
                                            <td>Premiação</td>
                                            <td>Ações</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if($boloes->count() <= 0)
                                            <tr>
                                                <td class='text-center' colspan='9'>Você ainda não fez nenhum bolão.</td>
                                            </tr>
                                        @else
                                            @foreach($boloes as $bolao)
                                                <tr>
                                                    {{-- <td data-label='Id' class="align-middle">#{{ $bolao->id }}</td> --}}
                                                    <td data-label='Loteria' class="align-middle">{!! $bolao->lotery->getLabelInitials() !!}</td>
                                                    <td data-label='Concurso' class="align-middle">
                                                        <b>Nº {{ $bolao->concurso->number }}
                                                        - {{ $bolao->concurso->getDrawDay() }}</b>
                                                    </td>
                                                    <td data-label='Cotas' class="align-middle">{{ $bolao->cotas_available }} / {{ $bolao->cotas }}</td>
                                                    <td data-label='Preço' class="align-middle">{{ $bolao->getFormattedPrice() }}</td>
                                                    <td data-label='Status' class="align-middle"><strong class='text-warning'>{!! $bolao->getStatus() !!}</strong></td>
                                                    <td data-label='Premiação' class="align-middle">{{ $bolao->getFormattedPrize() }}</td>
                                                    <td data-label='Ações' class="align-middle">
                                                        <div class='d-flex justify-content-center'>
                                                            @if(! $bolao->active)
                                                                <a href="{{ route('web.boloes.activate', [$bolao->id]) }}"><i class="fas fa-dollar-sign ms-2 me-2 text-light rounded bg-success py-2 px-3" title='Pagar e ativar Bolão' role='button'></i></a>

                                                                <a data-toggle="modal" data-target="#bolaoInfosModal" data-gamesurl='{{ route("web.boloes.stats", [$bolao->id]) }}'><i class="fas fa-chart-bar text-light rounded bg-warning p-2" title='Relatório do Bolão' role='button'></i></a>
                                                            @endif

                                                            <a data-toggle="modal" data-target="#bolaoInfosModal" data-id='{{ $bolao->id }}' data-gamesurl='{{ route("web.boloes.games", [$bolao->id]) }}' class='ms-2 me-2 gamesTrigger bolao_{{ $bolao->id }}'>
                                                                <i class="fas fa-search text-light rounded bg-info p-2" title='Visualizar Jogos' role='button'></i>
                                                            </a>

                                                            @if ($bolao->canTransactionCotas())
                                                                <a data-toggle="modal" data-target="#bolaoInfosModal" data-gamesurl='{{ route("web.boloes.invite", [$bolao->id]) }}'><i class="fas fa-envelope ms-2 text-light rounded bg-success p-2" title='Presentar cotas' role='button'></i></a>
                                                            @endif
                                                            <!-- <a><i class="fas fa-plus text-light rounded bg-success p-2" title='Re-Criar Bolão' role='button'></i></a> -->
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div><!-- /profile-user-info -->    
            </div><!-- /main-box -->
        </div>
    </div>
    <!--end::Container-->
</div>
<!--end::Entry-->

@include('web.boloes.bolao_infos_modal')

@endsection