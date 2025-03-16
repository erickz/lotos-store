@extends('layouts.web.web')

@section('titlePage', 'Crie seu Próprio Bolão de Loteria aqui na ' . env('APP_NAME') . '!')
@section('descriptionPage', 'Monte seu próprio bolão de loteria e aumente suas chances de vitória. 
Compartilhe e venda seus jogos, maximize seus ganhos e ganhe prêmios incrivéis. Crie seu bolão agora mesmo!')

@section('content')

<!--begin::Entry-->
<div class="d-flex flex-column-fluid mt-5" id='user-profile'>
    <!--begin::Container-->
    <div class="container">
        <div class="col-lg-12">
            <div class="main-box clearfix">                
                <div class="row profile-user-info">
                    @include('web.boloes.wizard.menu_steps')
                    
                    @if ($loteries)
                        @include('web.boloes.wizard.choose_lotery')
                    @else
                        @include('web.boloes.wizard.build_games')
                    @endif

                    {{-- @include('web.boloes.bolaoBuilder') --}}
                </div><!-- /profile-user-info -->    
            </div><!-- /main-box -->
        </div>
    </div>
    <!--end::Container-->
</div>
<!--end::Entry-->

@endsection