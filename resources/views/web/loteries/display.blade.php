@extends('layouts.web.web')

@section('titlePage', 'Saiba mais informações sobre a ' . $lotery->name . ' aqui na ' . env('APP_NAME') . '!')
@section('descriptionPage', 'Descubra mais informações sobre a ' . $lotery->name . ' e jogue nas loterias online aqui na ' . env('APP_NAME') . '!' )

@section('content')

<!--begin::Entry-->
<div class="d-flex flex-column-fluid mt-5">
    <!--begin::Container-->
    <div class="container">
        <div class="row boloesListing">
            <div class='col-lg-12'>                    
                <div class='mt-2 min-h-400px'>
                    <div class='bg-white p-4 rounded'>
                        <h1 class='ps-0 mb-5 text-primary'><b>{{ $lotery->name }}</b></h1>
                        {!! $lotery->description2 !!}

                        @if($lotery->initials == 'MG')
                            <a href='{{ route("web.loteries.megasenaSpecial") }}' class='btn btn-primary'><b>Saiba também sobre a Mega da Virada</b></a>
                        @elseif($lotery->initials == 'LF')
                            <a href='{{ route("web.loteries.lotofacilSpecial") }}' class='btn btn-primary'><b>Saiba também sobre a Lotofácil de independência</b></a>
                        @elseif($lotery->initials == 'QN')
                            <a href='{{ route("web.loteries.quinaSpecial") }}' class='btn btn-primary'><b>Saiba também sobre a Quina de São João</b></a>
                        @elseif($lotery->initials == 'DS')
                            <a href='{{ route("web.loteries.duplasenaSpecial") }}' class='btn btn-primary'><b>Saiba também sobre a Dupla sena de páscoa</b></a>
                        @endif
                    </div>
                    @if ($mainListingBoloes->count() > 0)
                        <div class='col-lg-12 mt-5 p-0'>
                            <div>
                                <div class='d-flex align-items-center'>
                                    <h2 class='ps-0'><b>Confira nossos bolões mais populares da {{ $lotery->name }}</b></h2>
                                </div>
                                @include('web.boloes.listing_boloes', ['boloes' => $mainListingBoloes])
                            </div>
                        </div>
                    @endif
                    @include('web.boxes_to_action')
                </div>
            </div>
        </div>
    </div><!--end::Container-->
</div><!--end::Entry-->

@include('web.boloes.bolao_infos_modal')

@endsection