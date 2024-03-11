@extends('layouts.web.web')

@section('titlePage', 'Confira os bolões da loteria online da ' . env('APP_NAME') . '!')
@section('descriptionPage', 'Confira e compre cotas de bolões das suas loterias favoritas! Suas chances de ganhar são aumentadas! Aproveite e crie seu bolão também!')

@section('content')

{{-- Criar novo banner e colocar aqui
<div class='bannerHomepage text-center'>
    <img src='{{ asset("img/banner-home-v3.jpg") }} ' class='w-100'/>
</div><!-- /col-lg-12 -->
--}}

<!--begin::Entry-->
<div class="d-flex flex-column-fluid mt-5">
    <!--begin::Container-->
    <div class="container">
        <div class="row boloesListing">
            <div class='col-lg-12 mt-5'>
                <div class='d-flex justify-content-between align-items-end p-1'>
                    <div class=''>
                        <h1 class='ps-0 mb-0 text-secondary'>Grupo de Bolões</h1>
                        <h3 class='ps-0 pt-0 mt-0'>Por: {{ $customer->getFirstName() }}</h3>
                    </div>
                    {!! $shareButtons !!}
                </div>
                <div class='listingHolder'>
                    @if(count($boloes) > 0)
                        @include('web.boloes.listing_boloes', ['boloes' => $boloes, 'displayPagination' => true])
                    @else
                        <div class='alert alert-light'><i class='fas fa-info-circle me-2 text-primary'></i> Nenhum bolão cadastrado para os próximos concursos, seja o primeiro e <a href='{{ route("web.boloes.create") }}'>crie agora</a> seu bolão!</div>
                    @endif
                </div>
            </div>
        </div>
    </div><!--end::Container-->
</div><!--end::Entry-->

@include('web.boloes.bolao_infos_modal')

@endsection