@extends('layouts.web.web')

@section('titlePage', 'Página Inicial')

@section('content')

<div class='bannerHomepage text-center'>
    <img src='{{ asset("img/banner-home-v6.jpg") }} ' class='w-100'/>
</div><!-- /col-lg-12 -->

<!--begin::Entry-->
<div class="d-flex flex-column-fluid mt-5">
    <!--begin::Container-->
    <div class="container">
        <div class="d-flex flex-column-fluid">
            <div class="boloesListing w-100">
                <div class='col-lg-12 p-0'>                        
                    <h2 class='ps-0'>Grupos de Bolões: Mais populares</h2>
                    <table class='table table-white text-center mt-3 rounded'>
                        <thead>
                            <tr>
                                <td>Loteria</td>
                                <td>Data do Concurso</td>
                                <td>Nome</td>
                                <td>Qt. jogos</td>
                                <td>Prêmio estimado</td>
                                <td></td>
                                <td>Cotas</td>
                                <td>Preço</td>
                                <td colspan='2'>Comprar</td>
                            </tr>
                        </thead>
                        <tbody>
                            @if($mainListingBoloes->count() > 0)
                                @foreach($mainListingBoloes as $bolao)
                                    <tr>
                                        <td>{!! $bolao->lotery->getLabelInitials() !!}</td>
                                        <td>{{ $bolao->concurso->getDrawDay() }}</td>
                                        <td>{{ $bolao->name }}</td>
                                        <td>{{ $bolao->games->count() }}</td>
                                        <td class='color-default estimatedPrize'>
                                            <strong>{{ $bolao->concurso->getNextExpectedPrize() }}</strong>
                                        </td>
                                        <td>
                                            <a data-toggle="modal" data-target="#bolaoInfosModal" data-gamesurl='{{ route("web.boloes.games", [$bolao->id]) }}'><i class="fas fa-search text-light rounded bg-info p-2" title='Visualizar Jogos' role='button'></i></a>
                                        </td>
                                        <td>{{ $bolao->cotas_available }} / {{ $bolao->cotas }}</td>
                                        <td>{{ $bolao->getFormattedPrice() }}</td>
                                        <td align='right'>
                                            <div class='slHolder'>
                                                <select name='cotas' class='form-control slChooseCotas'>
                                                    @for($i = 0; $i <= $bolao->cotas_available; $i++)
                                                        <option value='{{ $i }}'>{{ $i }}</option>
                                                    @endfor
                                                </select>
                                            </div><!-- /slHolder -->
                                        </td>
                                        <td align='left' class='buyHolder'>
                                            <a class='cursor-p btn btn-success btn-sm btnBuyCota disabled' href='' data-toggle="modal" data-target="#buyConfirmationModal" data-gamesurl='{{ route("web.boloes.buy", [$bolao->id]) }}'><i class='fa fa-shopping-cart'></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
                <div class='col-lg-12 p-0 mt-8 d-flex'>
                    <div class='col-lg-6'>           
                        <h2 class='ps-0'>Maiores chances</h2>             
                        <table class='table table-white text-center mt-3 rounded p-2'>
                            <thead>
                                <tr>
                                    <td class='ps-4'>Loteria</td>
                                    <td>Data do Concurso</td>
                                    <td>Nome</td>
                                    <td></td>
                                    <td>Cotas</td>
                                    <td>Preço</td>
                                    <td></td>
                                    <td></td>
                                </tr>
                            </thead>
                            <tbody>
                                @if($biggestChances->count() > 0)
                                    @foreach($biggestChances as $bolao)
                                        <tr>
                                            <td>{!! $bolao->lotery->getLabelInitials() !!}</td>
                                            <td>{{ $bolao->concurso->getDrawDay() }}</td>
                                            <td>{{ $bolao->name }}</td>
                                            <td>
                                                <a data-toggle="modal" data-target="#bolaoInfosModal" data-gamesurl='{{ route("web.boloes.games", [$bolao->id]) }}'><i class="fas fa-search text-light rounded bg-info p-2" title='Visualizar Jogos' role='button'></i></a>
                                            </td>
                                            <td>{{ $bolao->cotas_available }} / {{ $bolao->cotas }}</td>
                                            <td>{{ $bolao->getFormattedPrice() }}</td>
                                            <td align='right'>
                                                <div class='slHolder'>
                                                    <select name='cotas' class='form-control slChooseCotas'>
                                                        @for($i = 0; $i <= $bolao->cotas_available; $i++)
                                                            <option value='{{ $i }}'>{{ $i }}</option>
                                                        @endfor
                                                    </select>
                                                </div>
                                            </td>
                                            <td align='left' class='pe-3'>
                                                <a class='cursor-p btn btn-success btn-sm btnBuyCota disabled' href='' data-toggle="modal" data-target="#buyConfirmationModal" data-gamesurl='{{ route("web.boloes.buy", [$bolao->id]) }}'><i class='fa fa-shopping-cart'></i></a>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                    <div class='col-lg-6 pe-0'>     
                        <h2 class='ps-0'>Mais econômicos</h2>                   
                        <table class='table table-white text-center mt-3 rounded'>
                            <thead>
                                <tr>
                                    <td class='ps-4'>Loteria</td>
                                    <td>Data do Concurso</td>
                                    <td>Nome</td>
                                    <td></td>
                                    <td>Cotas</td>
                                    <td>Preço</td>
                                    <td></td>
                                    <td></td>
                                </tr>
                            </thead>
                            <tbody>
                                @if($mostEconomics->count() > 0)
                                    @foreach($mostEconomics as $bolao)
                                        <tr>
                                            <td>{!! $bolao->lotery->getLabelInitials() !!}</td>
                                            <td>{{ $bolao->concurso->getDrawDay() }}</td>
                                            <td>{{ $bolao->name }}</td>
                                            <td>
                                                <a data-toggle="modal" data-target="#bolaoInfosModal" data-gamesurl='{{ route("web.boloes.games", [$bolao->id]) }}'><i class="fas fa-search text-light rounded bg-info p-2" title='Visualizar Jogos' role='button'></i></a>
                                            </td>
                                            <td>{{ $bolao->cotas_available }} / {{ $bolao->cotas }}</td>
                                            <td>{{ $bolao->getFormattedPrice() }}</td>
                                            <td align='right'>
                                                <div class='slHolder'>
                                                    <select name='cotas' class='form-control slChooseCotas'>
                                                        @for($i = 0; $i <= $bolao->cotas_available; $i++)
                                                            <option value='{{ $i }}'>{{ $i }}</option>
                                                        @endfor
                                                    </select>
                                                </div>
                                            </td>
                                            <td align='left' class='pe-3'>
                                                <a class='cursor-p btn btn-success btn-sm btnBuyCota disabled' href='' data-toggle="modal" data-target="#buyConfirmationModal" data-gamesurl='{{ route("web.boloes.buy", [$bolao->id]) }}'><i class='fa fa-shopping-cart'></i></a>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div><!-- /profile-user-info -->    
        </div>
    </div>
    <!--end::Container-->
</div>
<!--end::Entry-->

@include('web.boloes.bolao_infos_modal')

@endsection