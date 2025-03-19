@extends('layouts.web.web')

@section('titlePage', 'Listagem de cotas compradas')

@section('content')

@include('web.customers.register_modal')
@include('web.customers.login_modal')

<!--begin::Entry-->
<div class="d-flex flex-column-fluid mt-5" id='user-profile'>
    <!--begin::Container-->
    <div class="container">
        <div class="col-lg-12">
            <div class="main-box clearfix">

                <h1 class='ps-0 mb-4 text-primary'><b>Minhas compras</b></h1>
                @include('web.includes.alert')
                
                {{-- @include('web.customers.menu') --}}

                @if($reserves->count() > 0)
                    <h3 class="ps-0 border-0 mb-0"><b>Cotas em processamento:</b></h3>
                    <div class="mybets mb-8 border border-dashed rounded mt-2">
                        <div class='col-lg-12 p-0'>                        
                            <div class='b-table'>
                                <div class='bg-white rounded table-responsive-lg table-wrapper has-mobile-cards'>
                                    <table class='table table-white is-fullwidth is-striped is-hoverable text-center'>
                                        <thead>
                                            <tr>
                                                <td>Loteria</td>
                                                <td>Concurso</td>
                                                <td>Reservado até</td>
                                                <td>Cotas compradas</td>
                                                <td>Status</td>
                                                <td>Visualizar jogos</td>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if($reserves->count() <= 0)
                                                <tr>
                                                    <td class='text-center' colspan='9'>Nenhuma cota em processamento</td>
                                                </tr>
                                            @else
                                                @foreach($reserves as $reserve)
                                                    <tr>
                                                        <td data-label='Loteria' class="align-middle align-items-center">
                                                            {!! $reserve->bolao->lotery->getLabelInitials() !!}
                                                        </td>
                                                        <td data-label='Concurso' class="align-middle">
                                                            <b>Nº {{ $reserve->bolao->concurso->number }}
                                                            - {{ $reserve->bolao->concurso->getDrawDay() }}</b>
                                                        </td>
                                                        <td data-label='Reservado até' class="align-middle">{!! $reserve->getExpirationDateFormatted() !!}</td>
                                                        <td data-label='Cotas' class="align-middle">{{ $reserve->cotas }}</td>
                                                        <td data-label='Status' class="align-middle">
                                                            @if($reserve->isReserveActive())
                                                                <strong class="text-warning">Aguardando pagamento</strong>
                                                            @else
                                                                <strong class="text-danger">Pedido expirado</strong>
                                                            @endif
                                                        </td>
                                                        <td data-label='Visualizar jogos' class="align-middle">
                                                            <a data-toggle="modal" data-target="#bolaoInfosModal" data-id='{{ $reserve->bolao->id }}' data-gamesurl='{{ route("web.boloes.games", [$reserve->bolao->id]) }}' class='gamesTrigger bolao_{{ $reserve->bolao->id }}'><i class="fas fa-search text-light rounded bg-info p-2" title='Visualizar Jogos' role='button'></i></a>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div><!-- /b-table -->

                            <div class='d-flex justify-content-end mt-2'>
                                @if($boloesBought->count() > 0)
                                    {{ $boloesBought->withQueryString()->links('pagination::bootstrap-5') }}
                                @endif
                            </div>
                        </div>
                    </div><!-- /profile-user-info -->    
                @endif
                
                <h3 class="ps-0 border-0 mb-0"><b>Cotas compradas:</b></h3>
                <div class="mybets border border-dashed rounded mt-2">
                    
                    <div class='col-lg-12 p-0'>                        
                        <div class='b-table'>
                            <div class='bg-white rounded table-responsive-lg table-wrapper has-mobile-cards'>
                                <table class='table table-white is-fullwidth is-striped is-hoverable text-center'>
                                    <thead>
                                        <tr>
                                            <td>Loteria</td>
                                            <td>Concurso</td>
                                            <td>Data da compra</td>
                                            <td>Cotas compradas</td>
                                            <td>Status</td>
                                            <td>Premiação</td>
                                            <td>Visualizar jogos</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if($boloesBought->count() <= 0)
                                            <tr>
                                                <td class='text-center' colspan='9'>Você ainda não fez nenhuma compra.</td>
                                            </tr>
                                        @else
                                            @foreach($boloesBought as $bolaoBought)
                                                <tr>
                                                    <td data-label='Loteria' class="align-middle align-items-center">
                                                        {!! $bolaoBought->bolao->lotery->getLabelInitials() !!}
                                                    </td>
                                                    <td data-label='Concurso' class="align-middle">
                                                        <b>Nº {{ $bolaoBought->bolao->concurso->number }}
                                                        - {{ $bolaoBought->bolao->concurso->getDrawDay() }}</b>
                                                    </td>
                                                    <td data-label='Prêmio Estimado' class="align-middle">{!! $bolaoBought->bolao->concurso->getNextExpectedPrize() !!}</td>
                                                    <td data-label='Cotas' class="align-middle">{{ $bolaoBought->cotas }}</td>
                                                    <td data-label='Status' class="align-middle"><strong class='text-warning'>{!! $bolaoBought->bolao->getStatus() !!}</strong></td>
                                                    <td data-label='Prêmiação' class="align-middle">{{ $bolaoBought->bolao->getFormattedPrize() }}</td>
                                                    <td data-label='Visualizar jogos' class="align-middle">
                                                        <a data-toggle="modal" data-target="#bolaoInfosModal" data-id='{{ $bolaoBought->bolao->id }}' data-gamesurl='{{ route("web.boloes.games", [$bolaoBought->bolao->id]) }}' class='gamesTrigger bolao_{{ $bolaoBought->bolao->id }}'><i class="fas fa-search text-light rounded bg-info p-2" title='Visualizar Jogos' role='button'></i></a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div><!-- /b-table -->

                        <div class='d-flex justify-content-end mt-2'>
                            @if($boloesBought->count() > 0)
                                {{ $boloesBought->withQueryString()->links('pagination::bootstrap-5') }}
                            @endif
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