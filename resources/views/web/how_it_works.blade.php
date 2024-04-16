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

        <div class='w-100 mt-5'>
            <h2 class='ps-0'><b>Como fazer um Bolão na {{ env('APP_NAME') }}</b></h2>
            <div class="stepByStepCt howItWorksSteps d-flex justify-content-between d-flex-responsive">
                <div class='p-5 pt-8 me-2 text-white stepByStepHome shadow-sm rounded position-relative col'>
                    <div class='d-flex justify-content-center'>
                        <div class='numberStep mt-1 text-center'>
                            <span class='rounded display-5 rounded-circle bg-primary p-2 px-7 me-2'><b>1</b></span> 
                        </div>
                        <div class='stepIcon text-center'>
                            <i class='display-2 far fa-hand-pointer text-primary'></i>
                        </div>
                    </div><!-- / -->
                    <div class='titleStep mb-5 text-center'>
                        <span class='titleName text-primary'><b>Cadastre-se</b></span>
                    </div>
                    <div class='text-primary text-center'>
                        Em menos de 1 minutinho você se <a data-toggle="modal" class='cursor-pointer' data-target="#registerModal"><u>cadastra na plataforma</u></a> do {{ env('APP_NAME') }} <b>- é fácil e prático</b>
                    </div>
                    <!-- <div class='iconHolder'>
                        <i class='fas fa-receipt text-white'></i>
                    </div> -->
                </div>
                <div class='p-5 pt-8 me-2 text-white stepByStepHome shadow-sm rounded position-relative col'>
                    <div class='d-flex justify-content-center'>
                        <div class='numberStep mt-1 text-center'>
                            <span class='rounded display-5 rounded-circle bg-primary p-2 px-6 me-2'><b>2</b></span> 
                        </div>
                        
                        <div class='stepIcon text-center'>
                            <i class='display-2 fas fa-hand-holding-usd text-primary'></i>
                        </div>
                    </div>
                    <div class='titleStep mb-5 text-center'>
                        <span class='titleName text-primary'><b>Compre créditos</b></span>
                    </div>
                    <div class='text-primary text-center'>
                        Acesse a <a href='{{ route("web.credits.index") }}'><u>página de créditos</u></a> e <b>selecione a opção que mais te atende</b>
                    </div>
                </div>
                <div class='p-5 pt-8 me-2 text-white stepByStepHome shadow-sm rounded position-relative col'>
                    <div class='d-flex justify-content-center'>
                        <div class='numberStep mt-1 text-center'>
                            <span class='rounded display-5 rounded-circle bg-primary p-2 px-6 me-2'><b>3</b></span> 
                        </div>
                        
                        <div class='stepIcon text-center'>
                            <i class='display-2 flaticon-list text-primary'></i>
                        </div>
                    </div>
                    <div class='titleStep mb-5 text-center'>
                        <span class='titleName text-primary'><b>Adquira cotas</b></span>
                    </div>
                    <div class='text-primary text-center'>
                        Na <a href='{{ route("web.boloes.listing") }}' class=''><u>listagem de bolões</u></a> selecione o grupo que mais te interessa e compre suas cotas
                    </div>
                </div>
            </div>
            <div class="stepByStepCt howItWorksSteps mt-2 d-flex justify-content-between d-flex-responsive">
                <!-- <div class='text-white p-5 pt-8 me-2 stepByStepHome shadow-sm rounded position-relative col'>
                    <div class='d-flex justify-content-center'>
                        <div class='numberStep mt-1 text-center'>
                            <span class='rounded display-5 rounded-circle bg-primary p-2 px-6 me-2'><b>4</b></span> 
                        </div>
                        
                        <div class='stepIcon text-center'>
                            <i class='display-2 flaticon-network text-primary'></i>
                        </div>
                    </div>
                    <div class='titleStep mb-5 text-center'>
                        <span class='titleName text-primary'><b>Venda ou Compartilhe</b></span>
                    </div>
                    <div class='text-primary text-center'>
                        Venda as cotas do seu Bolão na nossa plataforma afim de maximizar seus ganhos.
                        Você pode também <b>doar cotas para quantos amigos quiser!</b>
                    </div>
                </div> -->
                <div class='p-5 pt-8 me-2 text-white stepByStepHome shadow-sm rounded position-relative col'>
                    <div class='d-flex justify-content-center'>
                        <div class='numberStep mt-1 text-center'>
                            <span class='rounded display-5 rounded-circle bg-primary p-2 px-6 me-2'><b>4</b></span> 
                        </div>
                        
                        <div class='stepIcon text-center'>
                            <i class='display-2 flaticon-map text-primary'></i>
                        </div>
                    </div>
                    <div class='titleStep mb-5 text-center'>
                        <span class='titleName text-primary'><b>Conferência automática</b></span>
                    </div>
                    <div class='text-primary text-center'>
                        Após o concurso ser realizado, a {{ env("APP_NAME") }} realiza a conferência de todas as apostas automaticamente - <b>de forma eficiente e segura</b>
                    </div>
                </div>
                <div class='text-white p-5 pt-8 me-2 stepByStepHome shadow-sm rounded position-relative col'>
                    <div class='d-flex justify-content-center'>
                        <div class='numberStep mt-1 text-center'>
                            <span class='rounded display-5 rounded-circle bg-primary p-2 px-6 me-2'><b>5</b></span> 
                        </div>
                        
                        <div class='stepIcon text-center'>
                            <i class='display-2 flaticon-coins text-primary'></i>
                        </div>
                    </div>
                    <div class='titleStep mb-5 text-center'>
                        <span class='titleName text-primary'><b>Premiações</b></span>
                    </div>
                    <div class='text-primary text-center'>
                        Cada participante será premiado proporcionalmente a quantidade de cotas que possuir, <b>quantos mais cotas tiver maior será a premiação recebida</b>
                    </div>
                </div>
                <div class='text-white p-5 pt-8 me-2 stepByStepHome shadow-sm rounded position-relative col'>
                    <div class='d-flex justify-content-center'>
                        <div class='numberStep mt-1 text-center'>
                            <span class='rounded display-5 rounded-circle bg-primary p-2 px-6 me-2'><b>6</b></span> 
                        </div>
                        
                        <div class='stepIcon text-center'>
                            <i class='display-2 fas fa-reply-all text-primary'></i>
                        </div>
                    </div>
                    <div class='titleStep mb-5 text-center'>
                        <span class='titleName text-primary'><b>Solicite o saque</b></span>
                    </div>
                    <div class='text-primary text-center'>
                        Na página de <a href="<?php route('web.customers.rescue') ?>"><u>resgate de créditos</u></a>, solicite o <b>saque da sua premiação</b>
                    </div>
                </div>
            </div>
        </div>

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

        <div class='w-100 mt-5'>
            <div class='bg-white p-5 col-md-12 rounded'>
                <h2 class='ps-0 ms-1'><b>FAQ</b></h2>
                @include('web.faq_container', ['allFaq' => false])
            </div>
        </div>

        @include('web.includes.social-proof')

        @include('web.boxes_to_action')

    </div><!--end::Container-->
</div><!--end::Entry-->

@endsection