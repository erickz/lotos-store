@extends('layouts.web.web')

@section('titlePage', 'Página de recebimento de cotas')
@section('descriptionPage', 'Nesta página você confirma seus dados e efetiva o recebimento das cotas de presente!')

@section('content')

<div id="customer-register" class="d-flex flex-column-fluid mt-5">
    <!--begin::Container-->
    <div class="container">
        <!--begin::Card-->
        <div class="card card-custom rounded-top-0">
            <!--begin::Body-->
            <div class="card-body">
                <div class='col-lg-12'>
                    @if ($message)
                        <h1 class='ps-0 mb-0 text-secondary text-center mt-10'>Convite efetivado ✅</h1>
                        
                        <div class='col-lg-12 finishCheckoutMessage mt-5 mb-10 h-180px text-center'>
                            Este convite foi efetivado e a as cotas já recebidas! <br /> Acesse e veja seus jogos no painel do cliente: <br />

                            <div class='d-flex justify-content-center mt-5'>
                                <button class='btn btn-primary'><a href='{{ route("web.customers.mybuys") }}' class='text-white'><b>Meus jogos</b></a></button>
                            </div>
                        </div><!-- /col-lg-12 -->
                    @else
                        <h1 class='ps-0 mb-0 text-secondary text-center mt-10'>Cotas recebidas com successo 👍🏽</h1>
                        
                        <div class='col-lg-12 finishCheckoutMessage mt-5 mb-10 h-180px text-center'>
                            <p>
                                Seus dados foram confirmados e você recebeu <b>{{ $invite->cotas }} cota{{ $invite->cotas > 1 ? 's' : ''}}</b> de presente! <br />
                                Você agora está concorrendo ao concurso da <b>{{ $invite->bolao->lotery->name }}</b>:
                            </p>
                            <p>
                                <b>Concurso:</b> Nº{{ $invite->bolao->concurso->number }} - {{ $invite->bolao->concurso->getDrawDay() }} <br />
                                <b>Bolão:</b> {{ $invite->bolao->name }} <br />
                                <b>Quantidade de jogos:</b> {{ $invite->bolao->games->count() }} aposta{{ $invite->bolao->games->count() > 1 ? 's' : ''}} <br />
                            </p>

                            <div class='d-flex justify-content-center mt-5'>
                                <button class='btn btn-primary'><a href='{{ route("web.customers.mybuys") }}' class='text-white'><b>Veja seus jogos</b></a></button>
                                <button class='btn btn-success ms-5'><a href='{{ route("web.boloes.create") }}' class='text-white'><b>Crie um bolão você mesmo!</b></a></button>
                            </div>
                        </div><!-- /col-lg-12 -->
                    @endif
                </div><!-- /col-lg-12 -->
            </div>
        </div>
    </div>
</div>

@endsection