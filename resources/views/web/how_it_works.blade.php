@extends('layouts.web.web')

@section('titlePage', 'Como Funciona - Apostas Online e Venda de Bolões')
@section('descriptionPage', 'Descubra como funciona apostar na {{ env("APP_NAME") }}! - é simples e seguro participar das apostas online e vender seus bolões conosco. 
Aproveite nossa plataforma intuitiva e comece a apostar ou vender seus bolões hoje mesmo!')

@section('content')

<!--begin::Entry-->
<!--begin::Entry-->
<div class="mt-5 howItWorksCt">
    <!--begin::Container-->
    <div class="p-5 container">
        <h1 class='ps-0 mb-0 text-secondary'><b>Veja como funciona jogar na loteria online com a {{ env("APP_NAME") }}</b></h1>
        
        <section class="py-10" id="howItWorks">
            <div class="container">
                <div class="text-center mb-5">
                    <h1 class="display-5 mb-3"><b>Funciona em 4 passos</b></h1>
                    <p class="lead">Simples e eficiente para começar a vender</p>
                </div>

                <div class="row g-4 justify-content-center">
                    <!-- Passo 1 -->
                    <div class="col-md-3">
                        <div class="step-card text-center p-4 position-relative">
                            <div class="step-number bg-primary text-white rounded-circle d-inline-flex align-items-center justify-content-center">1</div>
                            <h3 class="h5 mt-4 text-primary"><b><i class="fas fa-trophy me-2 text-primary"></i>Criar</b></h3>
                            <p>Selecione a loteria e monte seus jogos</p>
                            <div class="step-arrow d-none d-md-block position-absolute top-50 end-0 translate-middle-y">
                                <i class="fas fa-arrow-right text-muted fa-2x"></i>
                            </div>
                        </div>
                    </div>

                    <!-- Passo 2 -->
                    <div class="col-md-3">
                        <div class="step-card text-center p-4 position-relative">
                            <div class="step-number bg-danger text-white rounded-circle d-inline-flex align-items-center justify-content-center">2</div>
                            <h3 class="h5 mt-4 text-danger"><b><i class="fas fa-rocket me-2 text-danger"></i>Lançamento</b></h3>
                            <p>Registre e ative o seu Bolão</p>
                            <div class="step-arrow d-none d-md-block position-absolute top-50 end-0 translate-middle-y">
                                <i class="fas fa-arrow-right text-muted fa-2x"></i>
                            </div>
                        </div>
                    </div>

                    <!-- Passo 3 -->
                    <div class="col-md-3">
                        <div class="step-card text-center p-4 position-relative">
                            <div class="step-number bg-warning text-white rounded-circle d-inline-flex align-items-center justify-content-center">3</div>
                            <h3 class="h5 mt-4 text-warning"><b><i class="fas fa-share-alt me-2 text-warning"></i>Divulgue</b></h3>
                            <p>Compartilhe o Bolão e venda suas cotas</p>
                            <div class="step-arrow d-none d-md-block position-absolute top-50 end-0 translate-middle-y">
                                <i class="fas fa-arrow-right text-muted fa-2x"></i>
                            </div>
                        </div>
                    </div>

                    <!-- Passo 4 -->
                    <div class="col-md-3">
                        <div class="step-card text-center p-4">
                            <div class="step-number bg-success text-white rounded-circle d-inline-flex align-items-center justify-content-center">4</div>
                            <h3 class="h5 mt-4 color-default"><b><i class="fas fa-money-bill me-2 color-default"></i>Receba</b></h3>
                            <p>Receba em sua conta bancária</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- <div class='w-100 mt-5'>
            <h2 class='ps-0'><b>Quero participar de bolões</b></h2>
            <div class="stepByStepCt d-flex justify-content-between d-flex-responsive">
                <div class='bg-danger p-5 me-2 text-white stepByStepHome position-relative col'>
                    <div class='titleStep d-flex flex-column mb-5'>
                        <span class='numberStep me-2'>0<b>1</b></span> 
                        <span class='titleName'><b>Cadastre-se</b></span>
                    </div>
                    <div>
                        Em menos de 1 minutinho você se <a data-toggle="modal" data-target="#registerModal">cadastra na plataforma</a> {{ env('APP_NAME') }} - é fácil e prático
                    </div>
                </div>
                <div class='bg-secondary text-danger p-5 me-2 stepByStepHome position-relative col'>
                    <div class='titleStep d-flex flex-column mb-5'>
                        <span class='numberStep me-2'>0<b>2</b></span> 
                        <span class='titleName'><b>Compre créditos</b></span>
                    </div>
                    <div>
                        Acesse a <a href='{{ route("web.credits.index") }}'><u>página de créditos</u></a> e selecione a opção que mais te atende
                    </div>
                </div>
                <div class='bg-danger p-5 me-2 text-white stepByStepHome position-relative col'>
                    <div class='titleStep d-flex flex-column mb-5'>
                        <span class='numberStep me-2'>0<b>3</b></span> 
                        <span class='titleName'><b>Compre cotas de um bolão</b></span>
                    </div>
                    <div>
                        Na <a href='{{ route("web.boloes.listing") }}' class='text-white'><u>listagem de bolões</u></a> escolha o bolão que mais te agrada e compre quantas cotas quiser
                        - lembrando que, quanto mais cotas você comprar, maior será sua recompensa ao ser premiado!
                    </div>
                </div>
                <div class='bg-secondary text-danger p-5 me-2 stepByStepHome position-relative col'>
                    <div class='titleStep d-flex flex-column mb-5'>
                        <span class='numberStep me-2'>0<b>4</b></span> 
                        <span class='titleName'><b>Aguarde a conferência</b></span>
                    </div>
                    <div>
                        Após o concurso ser realizado, a {{ env("APP_NAME") }} realiza a conferência de todas as apostas automaticamente.
                        Os participantes premiados receberão o valor do prêmio em créditos e caso desejado podem solicitar o saque na <a href='{{ route("web.customers.rescue") }}'><u>página de resgate</u></a>
                    </div>
                </div>
            </div>
        </div> -->

        @include('web.includes.social-proof')

        @include('web.call-to-action-contact')

    </div><!--end::Container-->
</div><!--end::Entry-->

@endsection