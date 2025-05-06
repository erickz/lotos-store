@extends('layouts.web.web')

@section('titlePage', 'Meu Painel | ' . env('APP_NAME'))
@section('descriptionPage', 'Acesse o seu perfil!')

@section('content')

@include('web.customers.register_modal')
@include('web.customers.login_modal')

<section class="py-40">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="display-5 mb-3"><b>Crie já um Bolão e venda suas cotas!</b></h2>
            <!-- <p class="lead">Segurança, transparência</p> -->
        </div>

        <div class="row justify-content-center align-items-center">
            <div class='text-center'>
                <a href="{{ route('web.boloes.create') }}" class="btn btn-success btn-lg mt-3"><b>Criar Bolão</b></a>
                <a href="{{ route("web.boloes.listing") }}" class="btn btn-primary btn-lg mt-3"><b>Ver Bolões</a>
            </div>
        </div>
    </div>
</section>

@endsection