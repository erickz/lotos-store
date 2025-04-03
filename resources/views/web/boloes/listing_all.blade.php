@extends('layouts.web.web')

@section('titlePage', 'Bolões da Mega sena, Lotofácil, Quina e Dupla sena | ' . env('APP_NAME'))
@section('descriptionPage', 'Confira a lista completa de bolões ' . (isset($lotery) && $lotery ? 'da ' . $lotery->name . '!' : 'das suas loterias favoritas!') . ' Aqui suas chances de ganhar são aumentadas, aproveite e crie seu bolão agora mesmo!')

@section('content')

<!--begin::Entry-->
<div class="d-flex flex-column-fluid mt-5 mb-4">
    <!--begin::Container-->
    <div class="container">
        <div class="row boloesListing">
            <div class='col-lg-12'>                        
                <h1 class='ps-0 mb-0 text-primary'><b>Grupo de Bolões {{ isset($lotery) && $lotery ? 'da ' . $lotery->name : '' }}</b></h1>
                
                <!-- <h3 class='ps-0'>Filtrar:</h3> -->
                <div class='mt-10 min-h-400px'>
                    <div class='col-lg-6 me-5 ps-0'>
                        <div class='bg-white rounded shadow-sm'>
                            <form action='{{ route("web.boloes.listing_all") }}' method='GET' class='p-4 d-flex flex-column'>
                                <h2 class='ps-0 pt-0'><b>Filtrar</b></h2>
                                <div class='d-flex justify-content-between mt-6'>
                                    <div class='me-4'>
                                        <b>Loteria:</b>
                                        <div class='slHolder'>
                                            <select name='lotery_id' class='form-control ps-3'>
                                                <option value=''>Selecionar</option>    
                                                <option value='1' {{ request()->get("lotery_id") == '1' ? "selected='selected'" : '' }}>Mega-sena</option>    
                                                <option value='2' {{ request()->get("lotery_id") == '2' ? "selected='selected'" : '' }}>Quina</option>
                                                <option value='3' {{ request()->get("lotery_id") == '3' ? "selected='selected'" : '' }}>Lotofácil</option>
                                                <option value='4' {{ request()->get("lotery_id") == '4' ? "selected='selected'" : '' }}>Dupla-Sena</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class='me-4'>
                                        <b>Concurso:</b>
                                        <div class='slHolder'>
                                            <select name='concurso_id' class='form-control ps-3'>
                                                <option value=''>Selecionar</option>
                                                @foreach($followingConcursos as $concurso)
                                                    <option value='{{ $concurso->id }}' {{ request()->get("concurso_id") == $concurso->id ? "selected='selected'" : '' }}>{{ strtoupper($concurso->lotery->initials) . '-' . $concurso->number }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class=''>
                                        <b>Ordenar por:</b>
                                        <div class='slHolder ps-0'>
                                            <select name='order_by' class='form-control ps-3'>
                                                <option value=''>Selecionar</option>
                                                <option value='price' {{ request()->get("order_by") == 'price' ? "selected='selected'" : '' }}>Preço</option>
                                                <option value='prize' {{ request()->get("order_by") == 'prize' ? "selected='selected'" : '' }}>Prêmio</option>
                                                <option value='qt_games' {{ request()->get("order_by") == 'qt_games' ? "selected='selected'" : '' }}>Qt de Jogos</option>
                                            </select>
                                        </div>
                                    </div>
                                </div><!-- / -->
                                <div class='ps-0 d-flex justify-content-end align-items-center mt-4'>
                                    <div>
                                        <a href='{{ route("web.boloes.listingByLot", ["megasena"]) }}' class='badge badge-pill mt-2 bg-success text-white'>Mega sena</a>
                                        <a href='{{ route("web.boloes.listingByLot", ["lotofacil"]) }}' class='badge badge-pill mt-2 bg-info2 text-white'>Lotofácil</a>
                                        <a href='{{ route("web.boloes.listingByLot", ["quina"]) }}' class='badge badge-pill mt-2 bg-info text-white'>Quina</a>
                                        <a href='{{ route("web.boloes.listingByLot", ["duplasena"]) }}' class='badge badge-pill mt-2 bg-danger text-white'>Dupla sena</a>
                                    </div>
                                    <div class='ms-auto'>
                                        <button href='{{ route("web.boloes.listing") }}' class='btn btn-info' type='submit'>Filtrar</button>
                                    </div>
                                </div><!-- /col-md-2 -->
                            </form><!-- /form -->
                        </div>
                    </div>
                    <div class='col-lg-12 mt-5 p-0'>
                        @if(count($boloes) > 0)
                            @include('web.boloes.listing_boloes', ['boloes' => $boloes, 'displayPagination' => true])
                        @else
                            <div class='alert alert-light'><i class='fas fa-info-circle me-2 text-primary'></i> Nenhum bolão cadastrado para os próximos concursos, seja o primeiro e <a href='{{ route("web.boloes.create") }}'>crie agora</a> seu bolão!</div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div><!--end::Container-->
</div><!--end::Entry-->

@include('web.boloes.bolao_infos_modal')

@endsection