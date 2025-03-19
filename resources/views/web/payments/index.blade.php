@extends('layouts.checkout.checkout')

@section('titlePage',  'Seu Carrinho de Compras - Loterias Fáceis ' . env('APP_NAME'))
@section('descriptionPage',  'Confira o seu carrinho de compras na ' . env('APP_NAME') . '. 
Verifique os bilhetes selecionados, finalize seus jogos e esteja pronto para concorrer aos grandes prêmios das 
loterias. Garanta sua participação nos sorteios e aumente suas chances de ganhar!')

@section('content')

<!--begin::Entry-->
<div class="mt-5">
    <div class='col-md-12'>
        {{-- @include('web.payments.menu') --}}
        
        <div class='d-flex justify-content-between d-flex-responsive mt-5'>
            <div class='ps-0 col me-2 mt-4'>
                <h1 class='ps-0 text-secondary'><b>Escolha a forma de pagamento:</b></h1>
                <div id='tgPaymentWay' class='bg-white p-5 border-radius min-h-150px'>
                    @include('web.includes.alert')
                    <div class='chosePaymentWay d-flex justify-content-between align-items-center'>
                        <div class='col text-center me-2'>
                            <button type='button' class='btn btn-outline-primary togglePaymentMethod w-100 min-h-100px {{ ! $isPix ? 'active' : '' }}' data-target='tgCreditCard'>
                                <div class='d-block'>
                                    <i class='fas fa-credit-card icon-3x'></i>
                                </div>
                                <div class='d-block'>
                                    <h3 class='p-0 mt-2 mb-0 text-uppercase'><b>Cartão de crédito</b></h3>
                                </div>
                            </button>
                        </div>
                        <div class='col text-center'>
                            <button type='button' class='btn btn-outline-primary togglePaymentMethod w-100 min-h-100px {{ $isPix ? 'active' : '' }}' data-target='tgPixWay'>
                                <div class='d-block'>
                                    <i class='fas fa-comment-dollar color-primary icon-3x'></i>
                                </div> 
                                <div class='d-block'>
                                    <h3 class='p-0 mt-2 text-uppercase'>
                                        <b>PIX</b>
                                    </h3>
                                </div>
                            </button>
                        </div>
                    </div><!-- /d-flex -->
                    <div class='tgCreditCard {{ $isPix ? '' : 'showPayment' }}' style='{{ $isPix ? 'display: none;' : '' }}'>
                        <form id='paymentForm' action='{{ route("web.payments.store") }}' method="POST" class='mt-4'>
                            @csrf

                            <input type='hidden' name='paymentType' value='credit_card' />

                            <div class='alert'></div>

                            <div class='card-wrapper'></div>

                            <div class='col-md-12 mb-2'>
                                <input placeholder="Número do cartão" type="tel" name="number" class='form-control cardNumber' required>
                            </div>
                            <div class='col-md-12 mb-2 d-flex'>
                                <div class='col-md-6 ps-0 me-2'>
                                    <input placeholder="MM/YYYY" type="tel" name="expiry" class='form-control cardExpiration' required>
                                </div>
                                <div class='col-md-6 ps-0'>
                                    <input placeholder="CVC" type="number" name="cvc" class='form-control cardCcv' required>
                                </div>
                            </div>
                            @if(! auth()->guard('web')->check())
                                <div class='col-md-12 mb-2 mt-8'>
                                    <h3 class="ps-0"><b>Identificação do Comprador</b></h3>
                                    <input placeholder="Nome Completo*" type="text" name="full_name" class='form-control cardFullname' required>
                                </div>
                                <div class='col-md-12 mb-2'>
                                    <input placeholder="CPF*" type="text" name="cpf" class='form-control maskCpf' required>
                                </div>
                                <div class='col-md-12 mb-2 d-flex'>
                                    <div class='col-md-6 ps-0 me-2'>
                                        <input placeholder="Email*" type="text" name="email" class='form-control' required>
                                    </div>
                                    <div class='col-md-6 ps-0'>
                                        <input placeholder="Senha*" minlength="6" type="password" name="password" class='form-control passwordField' required>
                                    </div>
                                </div>
                            @else
                            <div class='col-md-12 mb-2'>
                                    <input placeholder="Nome Completo*" type="text" name="full_name" class='form-control cardFullname' required>
                                </div>
                                <div class='col-md-12 mb-2'>
                                    <input placeholder="CPF*" type="text" name="cpf" class='form-control maskCpf' required>
                                </div>
                            @endif
                            
                            <div class='col-md-12 mt-4 text-end'>
                                <button class='btn btn-primary btnSubmitForm'><b>Pagar com Cartão</b></button>
                            </div>
                        </form>
                    </div>
                    <div class='tgPixWay mt-2 {{ ! $isPix ? '' : 'showPayment' }}' style='{{ ! $isPix ? 'display: none;' : '' }}'>
                        <div class='col-md-12 min-h-100px d-flex flex-direction-column justify-content-center align-items-center my-10'>
                            <form action='{{ route("web.payments.store") }}' method="POST" class='col-md-12'>
                                @csrf

                                <input type='hidden' name='paymentType' value='pix' />

                                @if(auth()->guard('web')->check())
                                    <h3 class="ps-0"><b>Identificação do comprador</b></h3>
                                    <div class="col-md-12 d-flex ps-0">
                                        <div class='col-md-6 mb-4 ps-0 mt-2'>
                                            <p>
                                                <b>Nome:</b> {{ auth()->guard('web')->user()->full_name }}
                                            </p>
                                            <p>
                                                <b>CPF:</b> {{ auth()->guard('web')->user()->cpf }}
                                            </p>
                                            <p>
                                                <b>Email:</b> {{ auth()->guard('web')->user()->email }}
                                            </p>
                                        </div>
                                    </div>
                                @else
                                    <h3 class="ps-0"><b>Identificação do comprador</b></h3>
                                    <div class="col-md-12 d-flex ps-0">
                                        <div class='col-md-6 mb-4 ps-0'>
                                            <input placeholder="Nome Completo*" type="text" name="full_name" class='form-control' required value="{{ old('name') }}">
                                        </div>
                                        <div class='col-md-6 mb-4'>
                                            <input placeholder="CPF*" type="text" name="cpf" class='form-control maskCpf' required value="{{ old(key: 'document') }}">
                                        </div>
                                    </div>
                                    <div class="col-md-12 d-flex ps-0">
                                        <div class='col-md-6 mb-4 ps-0'>
                                            <input placeholder="Email*" type="email" name="email" class='form-control' required value="{{ old('email') }}">
                                        </div>
                                        <div class='col-md-6 mb-4'>
                                            <input placeholder="Senha*" minlength="6" type="password" name="password" class='form-control passwordField' required>
                                        </div>
                                    </div>
                                @endif

                                
                                <div class='col-md-12 text-center mt-4'>
                                    <button class='btn btn-primary btnSubmitForm btn-lg'><b>Pagar com PIX</b></button>
                                </div>
                            </form>
                        </div>
                    </div><!-- /tgPixWay -->
                </div><!-- /bg-white -->
            </div><!-- /col-md-3 -->

            <div class='mt-15 sidebarCheckout'>
                <div class='bg-white p-4 ps-2 border-radius text-center d-flex flex-column justify-content-between'>
                    <h3 class='text-secondary text-start mb-4'><b>Resumo do pedido:</b></h3>

                    @if (auth()->guard('web')->check())
                        <div class='col-md-12'>
                            <strong>Nome:</strong> {{ auth()->guard('web')->user()->getFirstName() }}
                        </div><!-- /col-md-12 -->
                        <div class='col-md-12'>
                            <strong>Crédito atual:</strong> {{ auth()->guard('web')->user()->getFormattedCredits() }}
                        </div><!-- /col-md-12 -->
                    @endif
                    @if(session()->has('cart.customBolao') && $totalCotasReserved <= 0)
                        <div class='col-md-12'>
                            <span class='position-relative'>
                                <b>Qt. de jogos:</b> {{ $bolaoToPay->quantity_games }} jogos
                            </span>
                        </div><!-- /col-md-12 -->
                        <div class='col-md-12 text-center my-4'>
                            <b class='color-default'>
                                BOLÃO COM <br />
                                <i class='label label-inline bg-default font-larger px-2 py-1 chancesTg'>
                                    <b>{{ $bolaoToPay->chances }}x MAIS CHANCES</b>
                                </i><br />
                                DE GANHAR!
                            </b>
                        </div><!-- /col-md-12 -->
                    @endif
                    @if($totalCotasReserved > 0)
                        <div class='col-md-12'>
                            <span class='position-relative'>
                                <b>Cotas selecionadas:</b> {{ $totalCotasReserved }} cotas
                            </span>
                        </div><!-- /col-md-12 -->
                        <div class='col-md-12'>
                            <span class='position-relative'>
                                <b>Qt. de jogos:</b> {{ $totalGames }} {{ Str::plural('jogo', $totalGames) }}
                            </span>
                        </div><!-- /col-md-12 -->
                        <div class='col-md-12 text-center my-4'>
                            <b class='color-default'>
                                BOLÃO COM <br />
                                <i class='label label-inline bg-default font-larger px-2 py-1 chancesTg'>
                                    <b>{{ $totalChances }}x MAIS CHANCES</b>
                                </i><br />
                                DE GANHAR!
                            </b>
                        </div><!-- /col-md-12 -->
                        <div class='col-md-12 text-center'>
                            <div class='border border-bottom mt-3 mb-3'></div>
                        </div><!-- /col-md-12 -->
                    @endif
                    @if(session()->has('payment.isMinimum'))
                        <div class='col-md-12'>
                            <strong class='position-relative'>
                                Total a pagar: R${{ number_format(session()->get('payment.toPay'), 2, ',', '.') }} 
                                <i class='fa fa-question-circle font-smaller position-absolute top-0 start-100 translate-middle tooltips' data-toggle="tooltip" data-placement="top" data-html="true" title="Valor arredondado para o pagamento mínimo aceito"></i>
                            </strong>
                        </div><!-- /col-md-12 -->
                    @else
                        <div class='col-md-12 d-flex'>                            
                            <strong>Total a pagar: R${{ number_format(session()->get('payment.toPay'), 2, ',', '.') }} </strong> <br />
                        </div><!-- /col-md-12 -->
                    @endif
                </div><!-- /bg-white -->
            </div><!-- /col-md-3 -->
        </div><!-- /d-flex -->
    </div><!-- /col-md-12 -->

    {{-- @include('web.includes.social-proof') --}}
</div><!--end::Entry-->

<script type='text/javascript'>
    var checkoutSessionId = "{{ $sessionId }}"
</script>

@endsection