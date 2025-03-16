@extends('layouts.web.web')

@section('titlePage', 'Confira os bolões da loteria online da ' . env('APP_NAME') . '!')
@section('descriptionPage', 'Confira e compre cotas de bolões das suas loterias favoritas! Suas chances de ganhar são aumentadas! Aproveite e crie seu bolão também!')

@section('content')

{{-- Criar novo banner e colocar aqui
<div class='bannerHomepage text-center'>
    <img src='{{ asset("img/banner-home-v3.jpg") }} ' class='w-100'/>
</div><!-- /col-lg-12 -->
--}}


<div class="profile-header border border-radius border-secondary text-center p-4 bg-secondary">
    <div class="image-input image-input-outline image-input-circle" id="kt_image_3">
        @if($customer->profile_image)
            <div class="image-input-wrapper" style="background-image: url({{ asset('img/profile_images/' . $customer->profile_image) }})"></div>
        @else
            <div class="image-input-wrapper mb-4" style="background-image: url({{ asset('img/no-profile-image.png') }}); "></div>
        @endif
    </div>
    <h1 class="p-0 display-4"><b>{{ $customer->getProfileName() }}</b></h1>
    <p class="mb-1"><strong>Bolões criados: {{ $customer->boloes->count() }} {{ $customer->boloes->count() > 0 ? 'Bolões' : 'Bolão' }}</strong></p>
    <p class="mb-1"><strong>Membro desde: {{ $customer->getCreatedAgo() }} atrás</strong></p>
    <p class="mb-1"><strong>Criador: {{ $customer->getFullName() }}</strong></p>
</div>

@if($bolaoFeatured)
    <div class="bg-white border-radius p-0 mt-4">
        <div class="container">
            <div class="d-flex w-100">
                <div class='mt-3 ms-5'>
                    <h4 class=''>
                        <span class='d-flex'>
                            @if($bolaoFeatured->concurso->type == 2 && $bolaoFeatured->lotery_id == 1)
                                <i class='iconMg me-2'></i> 
                            @endif
                            <span class='mt-1 display-4'><b>Bolão da {{ $bolaoFeatured->concurso->type == 2 ? $bolaoFeatured->concurso->getSpecialName() : $bolaoFeatured->lotery->name }} </b></span>
                        </span>
                    </h4>
                    <div class='mb-2'>
                        {!! $bolaoFeatured->getLblChances() !!}
                    </div>
                </div>
            </div>

            <div class="descriptionBolao p-2 ps-5">
                {{  $bolaoFeatured->description }}
            </div>
        </div>

        <div class='mb-2 mt-4'>
            <div class='border border-secondary'></div>
        </div>

        <div class="">
            <div class='gamesList mt-4'>
                <div class='alert alert-{{ $bolaoFeatured->lotery->getColorClass() }} d-flex justify-content-center'>
                    <div class='text-center me-9'>
                        <span>Data do concurso</span> <br />
                        <strong class='font-larger'>{{ $bolaoFeatured->concurso->getDrawDay() }}</strong>
                    </div>
                    <div class='text-center me-9'>
                        <span>Prêmiação estimada</span> <br />
                        <strong class='font-larger'>{!! $bolaoFeatured->concurso->getNextExpectedPrize() !!}</strong>
                    </div>
                    <div class='text-center me-9'>
                        <span>Concurso</span> <br />
                        <strong class='font-larger'>Nº {{ $bolaoFeatured->concurso->number }}</strong>
                    </div>
                    <div class='text-center'>
                        <span>Quantidade de jogos</span> <br />
                        <strong class='font-larger'>{{ $bolaoFeatured->getQtGames() }}</strong>
                    </div>
                </div><!-- /alert -->

                <?php 
                $num = sprintf("%04d", 1);
                ?>
                <ul class='list text-center mb-0 ps-2 overflow-scroll mh-350px'>
                    @foreach($bolaoFeatured->games as $game)
                        <li class='mb-2'>
                            <span class=''>
                                <strong class='id-game d-inline-block mt-2'>{{ sprintf("%04d", $num++) }}</strong> - 
                            </span>
                            <span class='col ms-2'>
                                @foreach(explode(',', $game->numbers) as $number)
                                    <span class='number bg-light border border-{{ $bolaoFeatured->lotery->getColorClass() }} rounded rounded-circle w-35px text-center p-2 mb-1 d-inline-block {{ $game->prized ? "bg-success text-white" : "text-" . $bolaoFeatured->lotery->getColorClass() }}'><b>{{ str_replace(',', '', sprintf("%02d", $number)) }}</b></span>
                                @endforeach
                                @if($game->prized)
                                    <span class=''><b class="text-success"><i class="fas fa-star text-success"></i> Premiado:</b> {{ $game->getFormattedPrize() }}</span>
                                @endif
                            </span>
                        </li>
                    @endforeach
                </ul>

                @if ($bolaoFeatured->isValidToBuy())

                    <form class='bt-containers mt-5'>
                        @csrf

                        <div class='mb-2 mt-4'>
                            <div class='border border-secondary'></div>
                        </div>

                        <div class="col-md-5 m-auto">
                            <div class='alert d-none'></div>
                        </div>
                        
                        <div class='d-flex align-items-center justify-content-center pt-2 pb-6'>
                            <div class='mx-2'>
                                @if(auth()->guard('web')->check())
                                    <div>
                                        Seu saldo: <strong class='font-larger creditsUser' data-value="{{ auth()->guard('web')->user()->credits }}">{{ auth()->guard('web')->user()->getFormattedCredits() }}</strong>
                                    </div>
                                    <div>
                                        Valor a pagar: <strong class='font-smaller calculateTotal' data-price='{{ $bolaoFeatured->price }}'>R$0,00</strong>
                                    </div>
                                @else
                                    <div>
                                        Valor a pagar: <strong class='font-smaller calculateTotal' data-price='{{ $bolaoFeatured->price }}'>R$0,00</strong>
                                    </div>
                                @endif
                            </div>
                            <div class='d-flex mx-2 buyHolder'>
                                <div class='slHolder me-1'>
                                    <select name='cotas' class='form-control slChooseCotas'>
                                        @for($i = 0; $i <= $bolaoFeatured->getAvailableCotas(); $i++)
                                            <option value='{{ $i }}'>{{ $i }}</option>
                                        @endfor
                                    </select>
                                </div>
                                <div class='btn btnBuyCota btnBuyValidate btn-success ms-auto resetBuy disabled' data-toggle="modal" data-target="#buyConfirmationModal" data-gamesurl='{{ route("web.boloes.buy", [$bolaoFeatured->id]) }}'><i class='fa fa-shopping-cart'></i>Comprar</div>
                            </div>
                        </div>
                    </form>
                @endif
            </div>
        </div>
    </div>
@else
    @if ($customer->id == auth()->guard('web')->user()->id)
        <div class='container p-0 mt-8 col-md-6'>
            <div class="text-center my-5">
                <h3><b>Ops! Parece que você ainda não criou nenhum bolão.</b></h3>
                <p>Que tal começar agora? Crie seu bolão e convide seus amigos para participar!</p>
                <a href="{{ route('web.boloes.create') }}" class="btn btn-primary"><b>Criar Bolão</b></a>
            </div>
        </div>
    @else 
        <div class='container p-0 mt-8 col-md-6'>
            <div class="text-center my-5">
                <h3><b>Ops! Parece que não há nenhum bolão para os próximos concursos.</b></h3>
                <p></p>
                <a href="{{ route('web.boloes.create') }}" class="btn btn-primary"><b>Crie um bolão você também</b></a>
            </div>
        </div>
    @endif
@endif

@if(count($boloes) > 0)
    <div class='container p-0 mt-8'>
        <h2 class="p-0 ps-1 mb-0 display-4"><b>Confira outros Bolões</b></h2>
        <div class="row boloesListing">
            <div class='col-lg-12 mt-5'>
                <div class='listingHolder'>
                    @if(count($boloes) > 0)
                        @include('web.boloes.listing_boloes', ['boloes' => $boloes, 'displayPagination' => true])
                    @else
                        <div class='alert alert-light'><i class='fas fa-info-circle me-2 text-primary'></i> Nenhum bolão ativo</div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endif

<div class="mt-8 py-4 pb-8" style="background-color: #eaab23;">
    <div class="container social-links text-center my-5">
        <h2 class="ps-0 display-4 mb-5 text-white"><b>Compartilhe!</b></h2>
        <div class='shareButtons onGamesModal shareFromCustomerPage text-center font-larger'>
            {!!
            Share::page(url()->current(), '🎉🏆 Junte-se a Bolões vencedores e receba prêmios imperdíveis! 🏆')
    ->facebook()
    ->twitter()
    ->telegram()
    ->whatsapp()
             !!}
        </div>
    </div>
</div>

<div class="pt-4 mt-8 py-4 bg-info">
    <div class="container social-links text-center my-5">
        <h2 class="ps-0 display-4 mb-5 text-white"><b>Garantia {{ env('APP_NAME') }}</b></h2>
        <div class="text-center text-white my-6">
            <i class="fas fa-shield-alt text-white" style="font-size: 6em"></i>
        </div>
        <div class="text-center text-white font-larger">
            <b>Para garantir a segurança do processo acompanhamos o resultado dos concursos e distribuímos os prêmios aos vencedores.
        </div>
    </div>
</div>


{{--
<!--begin::Entry-->
<div class="d-flex flex-column-fluid mt-5">
    <!--begin::Container-->
    <div class="container">
        <div class="row boloesListing">
            <div class='col-lg-12 mt-5'>
                <div class='d-flex justify-content-between align-items-end p-1'>
                    <div class=''>
                        <h1 class='ps-0 mb-0 text-secondary'><b>Confira os Bolões</b></h1>
                        <h3 class='ps-0 pt-0 mt-0'><b>Por: {{ $customer->getProfileName() }}</b></h3>
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

--}}

@include('web.boloes.bolao_infos_modal')

@endsection