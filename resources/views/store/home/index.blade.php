@extends('layouts.web.web')

@section('titlePage', 'Bem vindo a ' . env("APP_NAME") . '!')
@section('descriptionPage', 'Cadastre-se, compre cotas ou faça e venda seus próprios bolões online agora mesmo!')

@section('content')

<div class='bannerHomepage text-center' style='background-color: #202020'>
    <img data-src='{{ asset("img/banner-home.png?v=2") }} ' class='w-100 unveil'/>
</div><!-- /col-lg-12 -->

<div class='d-flex flex-column'>
    <!--begin::Entry-->
    <div class="d-flex flex-column-fluid mt-5">
        <!--begin::Container-->
        <div class="container">
            <h2 class='ps-0 text-primary'><b>Aposte na {{ env('APP_NAME') }}!</b></h1>
            
            <h2 class='ps-1 pb-0'><b class='text-info3'>Como funciona</b></h2>
            <div class="stepByStepCt d-flex justify-content-between d-flex-responsive">
                <div class='bg-info p-5 me-2 text-white stepByStepHome position-relative col'>
                    <div class='titleStep d-flex flex-column mb-5'>
                        <span class='numberStep me-2'>0<b>1</b></span> 
                        <span class='titleName'><b>Crie sua conta</b></span>
                    </div>
                    <div>
                        <a class='cursor-pointer text-white' data-toggle="modal" data-target="#registerModal">
                            <b>Crie sua conta grátis</b>
                        </a> e comece a participar
                    </div>
                    <!-- <div class='iconHolder'>
                        <i class='fas fa-receipt text-white'></i>
                    </div> -->
                </div>
                <div class='bg-secondary text-info3 p-5 me-2 stepByStepHome position-relative col'>
                    <div class='titleStep d-flex flex-column mb-5'>
                        <span class='numberStep me-2'>0<b>2</b></span> 
                        <span class='titleName'><b>Adquira Cotas</b></span>
                    </div>
                    <div>
                        Confira a lista de Bolões, escolha o seu favorito e compre a quantidade de cotas desejada
                    </div>
                    <!-- <div class='iconHolder'>
                        <i class='fas fa-share-alt text-gray'></i>
                    </div> -->
                </div>
                <div class='bg-info p-5 me-2 text-white stepByStepHome position-relative col'>
                    <div class='titleStep d-flex flex-column mb-5'>
                        <span class='numberStep me-2'>0<b>3</b></span> 
                        <span class='titleName'><b>Verificação automática</b></span>
                    </div>
                    <div>
                        Após o concurso ser realizado, nossa plataforma verifica os resultados automaticamente e gerência as premiações, tudo isso <b>de forma segura e transparente</b>
                    </div>
                    <!-- <div class='iconHolder'>
                        <i class='fas fa-magic text-white'></i>
                    </div> -->
                </div>
                <div class='bg-secondary text-info3 p-5 me-2 stepByStepHome position-relative col'>
                    <div class='titleStep d-flex flex-column mb-5'>
                        <span class='numberStep me-2'>0<b>4</b></span> 
                        <span class='titleName'><b>Remunerações</b></span>
                    </div>
                    <div>
                        Ao final do concurso, o valor da premiação será distribuído de <b>de forma justa e proporcional as cotas de cada participantes.</b>
                    </div>
                    <!-- <div class='iconHolder'>
                        <i class='fas fa-hand-holding-usd text-gray'></i>
                    </div> -->
                </div>
            </div>
            <div class='mt-2 me-2 text-end'>
                <a href="{{ route('web.staticPages.howItWorks') }}" class='btn btn-primary'>
                    <div class='d-flex justify-content-end'>
                        <b>Saiba mais como funciona!</b>
                        <span class="svg-icon svg-icon-1.5x svg-icon-white me-0 ms-1 d-block">
                            <!--begin::Svg Icon | path:assets/media/svg/icons/Navigation/Angle-double-right.svg-->
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <polygon points="0 0 24 0 24 24 0 24"></polygon>
                                    <path d="M12.2928955,6.70710318 C11.9023712,6.31657888 11.9023712,5.68341391 12.2928955,5.29288961 C12.6834198,4.90236532 13.3165848,4.90236532 13.7071091,5.29288961 L19.7071091,11.2928896 C20.085688,11.6714686 20.0989336,12.281055 19.7371564,12.675721 L14.2371564,18.675721 C13.863964,19.08284 13.2313966,19.1103429 12.8242777,18.7371505 C12.4171587,18.3639581 12.3896557,17.7313908 12.7628481,17.3242718 L17.6158645,12.0300721 L12.2928955,6.70710318 Z" fill="#000000" fill-rule="nonzero"></path>
                                    <path d="M3.70710678,15.7071068 C3.31658249,16.0976311 2.68341751,16.0976311 2.29289322,15.7071068 C1.90236893,15.3165825 1.90236893,14.6834175 2.29289322,14.2928932 L8.29289322,8.29289322 C8.67147216,7.91431428 9.28105859,7.90106866 9.67572463,8.26284586 L15.6757246,13.7628459 C16.0828436,14.1360383 16.1103465,14.7686056 15.7371541,15.1757246 C15.3639617,15.5828436 14.7313944,15.6103465 14.3242754,15.2371541 L9.03007575,10.3841378 L3.70710678,15.7071068 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" transform="translate(9.000003, 11.999999) rotate(-270.000000) translate(-9.000003, -11.999999)"></path>
                                </g>
                            </svg>
                            <!--end::Svg Icon-->
                        </div>
                    </span>
                </a>
            </div>
            <h2 class='ps-1 pb-0 mt-5'><b class='text-info3'>Benefícios</b></h2>
            <div class="d-flex justify-content-between d-flex-responsive">
                <div class='bg-success text-white p-5 me-2 col benefitCard'>
                    <div class='d-flex align-items-center'>
                        <div class='iconStep me-5'><i class='fas text-white fa-star'></i></div>
                        <div>
                            <h2 class='ps-0 mb-0 pb-2'><b>Aumente suas chances</b></h2>
                            <div>
                                Maximize seus ganhos! Adquira as cotas de um bolão e tenha <b>muito mais chances de ganhar!</b>
                            </div>
                        </div>
                    </div>
                </div>
                <div class='bg-secondary text-info3 p-5 me-2 col benefitCard'>
                    <div class='d-flex align-items-center'>
                        <div class='iconStep me-5'><i class='fas text-info3 fa-chart-line'></i></div>

                        <div>
                            <h2 class='ps-0 mb-0 pb-2'><b>Bolões estratégicos!</b></h2>
                            <div>
                                Oferecemos bolões cuidadosamente elaborados, <b>baseados em análises estatísticas e estratégias de jogo.</b>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="d-flex justify-content-between mt-2 d-flex-responsive">
                <div class='bg-secondary p-5 me-2 text-info3 col benefitCard'>
                    <div class='d-flex align-items-center'>
                        <div class='iconStep me-5'><i class='fas text-info3 fa-lock'></i></div>

                        <div>
                            <h2 class='ps-0 mb-0 pb-2'><b>Premiações seguras</b></h2>
                            <div>
                                Premiações verificadas de forma <b>confiável e automática.</b>
                            </div>
                        </div>
                    </div>
                </div>
                <div class='bg-warning p-5 me-2 text-white col benefitCard'>
                    <div class='d-flex align-items-center'>
                        <div class='iconStep me-5'><i class='fas text-white fa-puzzle-piece'></i></div>

                        <div>
                            <h2 class='ps-0 mb-0 pb-2'><b>Fácil e Conveniente</b></h2>
                            <div>
                                Aposte online de forma rápida e segura, <b>tudo isso sem sair de casa.</b>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            @if ($mostPopulars->count() > 0)
                <div class='boloesListing mt-5'>
                    <h2 class='ps-0 color-default'><b class='d-flex'><i class='iconMg me-2'></i> <span>Bolões da Mega da Virada</span></b></h2>
                    @include('web.boloes.listing_boloes', ['boloes' => $mostPopulars])
                </div>
            @endif

            @include('web.includes.social-proof')
        </div>
        <!--end::Container-->
    </div>
    <!--end::Entry-->

    <div class='bg-info p-5 pb-12 mt-5 text-center text-white'>
        <div class='bigIconTitle'>
            🚀
            <!-- <i class='fas fa-rocket text-white' style='font-size: 60px'></i> -->
        </div>
        <div class='titleCall'>
            <b>Conquiste prêmios incríveis</b>
        </div>
        <div class='mt-4'>
            Faça parte da comunidade de bolões vencedores {{ (! auth()->guard('web')->check()) ? "e cadastre-se grátis" : "" }}
        </div>
        <div class='mt-5'>
            @if (! auth()->guard('web')->check())
                <button type="button" class="btn btn-success font-larger" data-toggle="modal" data-target="#registerModal">
                    <b>Cadastre-se!</b>
                </button>

                <a href="{{ route('web.boloes.create') }}" class="ms-2 btn btn-info2 font-larger">
                    <b>Ou faça já seu bolão</b>
                </a>
            @else
                <a href="{{ route('web.boloes.create') }}" class="btn btn-success font-larger">
                    <b>Faça já seu bolão</b>
                </a>
            @endif
        </div>
    </div>
</div>

@include('web.boloes.bolao_infos_modal')

@endsection