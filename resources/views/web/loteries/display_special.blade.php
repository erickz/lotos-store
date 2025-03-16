@extends('layouts.web.web')

@section('titlePage', $post->meta_title)
@section('descriptionPage', $post->meta_description)

@section('content')

<div class='bannerHomepage text-center mt-2 bg-black'>
    @mobile
        <img data-src='{{ asset("img/banner-mega-da-virada-mobile.jpeg") }} ' class='w-100 unveil'/>
    @elsemobile
        <video width="1000" style='object-fit: fill;' autoplay muted loop alt='Mega da Virada'>
            <source src="{{ asset('img/banner-mega-da-virada.mp4') }}" type="video/mp4" alt='Mega da Virada'>
        </video>
    @endmobile
</div><!-- /col-lg-12 -->

<!--begin::Entry-->
<div class="d-flex flex-column-fluid mt-5">
    <!--begin::Container-->
    <div class="container">
        <div class="row boloesListing">
            <div class='col-lg-12'>                    
                <div class='mt-2 min-h-400px'>
                    <!-- <div class=''>
                        <h1 class='ps-0 mb-5 text-primary'><b>Participe da {{ $post->title }}</b></h1>
                        {!! $post->description !!}
                    </div> -->

                    @if(count($specialBoloes) > 0)
                        <div class='mt-5'>
                            <h2 class='ps-0 color-default'><b class='d-flex'><i class='iconMg me-2'></i> <span>Compre os Melhores Bolões da Mega da Virada</span></b></h2>
                            <div>
                                <div class='d-flex align-items-center'>
                                    
                                </div>

                                @include('web.boloes.listing_boloes', ['boloes' => $specialBoloes])
                            </div>
                        </div><!-- / -->
                    @endif

                    <div class='my-4'>
                        <h2 class='ps-1 pb-0'><b class='text-info3'>Como apostar na Lotos Fácil</b></h2>
                        <div class="stepByStepCt d-flex justify-content-between d-flex-responsive">
                            <div class='bg-info p-5 me-2 text-white stepByStepHome position-relative col'>
                                <div class='titleStep d-flex flex-column mb-5'>
                                    <span class='numberStep me-2'>0<b>1</b></span> 
                                    <span class='titleName'><b>Monte seus jogos</b></span>
                                </div>
                                <div>
                                    Escolha suas dezenas da sorte, monte seu bolão e <b>aposte sem sair de casa.</b>
                                </div>
                                <!-- <div class='iconHolder'>
                                    <i class='fas fa-receipt text-white'></i>
                                </div> -->
                            </div>
                            <div class='bg-secondary text-info3 p-5 me-2 stepByStepHome position-relative col'>
                                <div class='titleStep d-flex flex-column mb-5'>
                                    <span class='numberStep me-2'>0<b>2</b></span> 
                                    <span class='titleName'><b>Venda ou Compartilhe seu Bolão</b></span>
                                </div>
                                <div>
                                    Venda as cotas do seu Bolão no nosso site afim de maximizar seus ganhos! Você pode também <b>doar cotas para quantos amigos quiser</b>.
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
                                    Ao final do concurso, o criador do bolão receberá <b>a receita das cotas vendidas</b> enquanto a premiação dos jogos será distribuída <b>de forma justa e proporcional as cotas de cada participantes.</b>
                                </div>
                                <!-- <div class='iconHolder'>
                                    <i class='fas fa-hand-holding-usd text-gray'></i>
                                </div> -->
                            </div>
                        </div>
                    </div>

                    <div class='mt-10'>
                        <h1 class='ps-1 pb-0'><b class='text-info3'>Sugestões de Bolões com Alta Probabilidade para a Mega da Virada</b></h1>
                        <div class="d-flex justify-content-between d-flex-responsive mt-4">
                            @foreach($suggestions->slice(0,3) as $suggestion)
                                <div class='bg-white px-6 col me-4 py-4 rounded mt-2'>
                                    <h3 class='m-0 p-0 pb-1 text-primary text-center text-uppercase mb-2'><b>{{ $suggestion->name }}</b></h3>

                                    <div class='mt-2'>
                                        <div class='mb-4'>
                                            <ol class='ps-0 w-75 d-flex flex-column m-auto min-h-50px'>
                                                @foreach( $suggestion->getBets() as $index => $bet )
                                                    <li class='w-75 m-auto d-flex justify-content-between'><span>{!! '<b>' . $bet . '</b> aposta' . ($bet > 1 ? 's ' : ' ') . 'de ' !!}</span>  <b class='text-primary'>{!! $index . ' dezenas' !!}</b></li>
                                                @endforeach
                                            </ol>
                                        </div>
                                        <div class='text-center mb-4'>
                                            <b>Preço:</b> <label class='label label-inline bg-primary text-white label-lg'><b>{{ $suggestion->getPrice() }}</b></label>
                                        </div>
                                        <div class='text-center mb-4'>
                                            <b class='text-danger'>
                                                <i class='label label-inline label-danger font-larger px-2 chancesTg'>
                                                    <b>{{ $suggestion->chances }}x MAIS CHANCES</b>
                                                </i>
                                                <br /> 
                                                DE GANHAR!
                                            </b>
                                        </div>
                                    </div>

                                    <div class='footerBox mt-2 text-center'>
                                        <button class='btn btn-lg btn-success px-5 font-larger' href='' data-toggle="modal" data-target="#bolaoSuggestionModal" data-id='{{ $suggestion->id }}' data-url='{{ route("web.boloes.suggestions", [$suggestion->id]) }}'><b>SIMULAR BOLÃO</b></button>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div class="d-flex justify-content-between d-flex-responsive mt-4">
                            @foreach($suggestions->slice(3,3) as $suggestion)
                                <div class='bg-white px-6 col me-4 py-4 rounded'>
                                    <h4 class='m-0 p-0 pb-1 text-primary text-center text-uppercase mb-2'><b>{{ $suggestion->name }}</b></h4>

                                    <div class='mt-2'>
                                        <div class='mb-4'>
                                            <ol class='ps-0 w-75 d-flex flex-column m-auto min-h-50px'>
                                                @foreach( $suggestion->getBets() as $index => $bet )
                                                    <li class='w-75 m-auto d-flex justify-content-between'><span>{!! '<b>' . $bet . '</b> aposta' . ($bet > 1 ? 's ' : ' ') . 'de ' !!}</span>  <b class='text-primary'>{!! $index . ' dezenas' !!}</b></li>
                                                @endforeach
                                            </ol>
                                        </div>
                                        <div class='text-center mb-4'>
                                            <b>Preço:</b> <label class='label label-inline bg-primary text-white label-lg'><b>{{ $suggestion->getPrice() }}</b></label>
                                        </div>
                                        <div class='text-center mb-4'>
                                            <b class='text-danger'>
                                                <i class='label label-inline label-danger font-larger px-2 chancesTg'>
                                                    <b>{{ $suggestion->chances }}x MAIS CHANCES</b>
                                                </i>
                                                <br /> 
                                                DE GANHAR!
                                            </b>
                                        </div>
                                    </div>

                                    <div class='footerBox mt-2 text-center'>
                                        <button class='btn btn-lg btn-success px-5 font-larger' href='' data-toggle="modal" data-target="#bolaoSuggestionModal" data-id='{{ $suggestion->id }}' data-url='{{ route("web.boloes.suggestions", [$suggestion->id]) }}'><b>SIMULAR BOLÃO</b></button>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div><!-- / -->
                </div>
            </div>
        </div>
    </div><!--end::Container-->
</div><!--end::Entry-->

<div class='container'>
    @include('web.includes.social-proof')
</div>

<div class='bg-info p-5 pb-12 mt-5 text-center text-white'>
    <div class='bigIconTitle'>
        🍀
    </div>
    <div class='titleCall'>
        <b>Monte seu próprio bolão</b>
    </div>
    <div class='mt-4'>
        Não perca a chance de participar <b>da maior loteria do ano</b> - crie já seu bolão!
    </div>
    <div class='mt-5'>
        @if (auth()->guard('web')->check())
            <button type="button" class="btn btn-warning font-larger" data-toggle="modal" data-target="#registerModal">
                <b>Cadastre-se!</b>
            </button>
        @endif

        <a href="{{ route('web.boloes.create', ['mg']) }}" class="btn btn-success font-larger">
            <b>Crie seu Bolão</b>
        </a>
    </div>
</div>

@include('web.boloes.bolao_suggestion_modal')
@include('web.boloes.bolao_infos_modal')

@endsection