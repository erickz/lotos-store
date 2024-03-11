@extends('layouts.web.web')

@section('titlePage', '404 - Página não encontrada!')
@section('descriptionPage', 'Sentimos muito, não pudemos encontrar a página!')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-12 mt-10 text-center">
            <div class="error-template">
                <h1 class='ps-0 text-info3'>Página não encontrada</h1>
                <div class="error-details">
                    Sentimos muito, um erro ocorreu e não pudemos encontrar a página!
                </div>
                <div class="error-actions mt-5">
                    <a href="{{ route('web.home') }}" class="btn btn-primary btn-lg">
                        <span class="glyphicon glyphicon-home"></span>
                        Acessar a Home
                    </a>
                    <a href="{{ route('web.staticPages.contact') }}" class="btn btn-light btn-lg">
                        <span class="glyphicon glyphicon-envelope"></span> 
                        Entrar em contato 
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection