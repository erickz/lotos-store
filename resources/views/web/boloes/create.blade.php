@extends('layouts.web.web')

@section('titlePage', 'Criar Bolão ' ($loteries ? 'das Loterias' : 'da ' . $lotery->name) . ' - Monte seus jogos | ' . env('APP_NAME'))
@section('descriptionPage', 'Crie o seu Bolão personalizado em 2 minutos! Escolha os números, defina os preços das cotas e concorra. Comece agora!')

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