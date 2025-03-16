@extends('layouts.checkout.checkout')

@section('titlePage',  'Seu Carrinho de Compras - Loterias Fáceis ' . env('APP_NAME'))
@section('descriptionPage',  'Confira o seu carrinho de compras na ' . env('APP_NAME') . '. 
Verifique os bilhetes selecionados, finalize suas apostas e esteja pronto para concorrer aos grandes prêmios das 
loterias. Garanta sua participação nos sorteios e aumente suas chances de ganhar!')

@section('content')

<!--begin::Entry-->
<div class="mt-5">
    <div class='col-md-12'>
        @include('web.payments.menu')
        
        <div class='d-flex justify-content-between d-flex-responsive mt-5'>
            <div class='ps-0 col me-2'>
                <h1 class='ps-0 text-secondary'>Pagamento</h1>
                @include('web.includes.alert')
                <div class='bg-white p-5 border-radius'>
                    <form id='paymentForm' action='{{ route("web.payments.store") }}' method="POST">
                        @csrf

                        <div class='alert'></div>

                        <div class='card-wrapper'></div>

                        <div class='col-md-12 mb-2'>
                            <input placeholder="Número do cartão" type="tel" name="number" class='form-control cardNumber' required>
                        </div>
                        <div class='col-md-12 mb-2'>
                            <input placeholder="Nome e Sobrenome" type="text" name="name" class='form-control cardFullname' required>
                        </div>
                        <div class='col-md-12 mb-2 d-flex'>
                            <div class='col-md-6 ps-0 me-2'>
                                <input placeholder="MM/YYYY" type="tel" name="expiry" class='form-control cardExpiration' required>
                            </div>
                            <div class='col-md-6 ps-0'>
                                <input placeholder="CVC" type="number" name="cvc" class='form-control cardCcv' required>
                            </div>
                        </div>
                        <div class='col-md-12'>
                            <input placeholder="CPF" type="text" name="document" class='form-control maskCpf' required>
                        </div>
                        
                        <div class='col-md-12 mt-4 text-end'>
                            <button class='btn btn-primary btnSubmitForm'>Pagar</button>
                        </div>
                    </form>
                </div><!-- /bg-white -->
            </div><!-- /col-md-3 -->

            <div class='mt-10 sidebarCheckout'>
                <div class='bg-white p-4 ps-2 border-radius text-center'>
                    <h3 class='text-secondary text-start'><b>Resumo do pedido:</b></h3>
                    <div class='col-md-12'>
                        <strong>Nome:</strong> {{ auth()->guard('web')->user()->getFirstName() }}
                    </div><!-- /col-md-12 -->
                    <div class='col-md-12'>
                        <strong>Crédito atual:</strong> {{ auth()->guard('web')->user()->getFormattedCredits() }}
                    </div><!-- /col-md-12 -->
                    <div class='col-md-12'>
                        <strong>Sua compra:</strong> <span class=''>R${{ number_format(session()->get('payment.total'), 2, ',', '.') }}</span>
                    </div><!-- /col-md-12 -->
                    @if(session()->has('cart.customBolao'))
                        <div class='col-md-12'>
                            <span class='position-relative'>
                                <b>Qt. de jogos:</b> {{ session()->get('cart.customBolao.quantity_games') }} jogos
                            </span>
                        </div><!-- /col-md-12 -->
                        <div class='col-md-12 text-center my-4'>
                            <b class='text-danger'>
                                BOLÃO COM <br />
                                <i class='label label-inline  label-danger font-larger px-2 py-1 chancesTg'>
                                    <b>{{ session()->get('cart.customBolao.chances') }}x MAIS CHANCES</b>
                                </i><br />
                                DE GANHAR!
                            </b>
                        </div><!-- /col-md-12 -->
                    @endif
                    <div class='col-md-12 text-center'>
                        <div class='border border-bottom mt-3 mb-3'></div>
                    </div><!-- /col-md-12 -->
                    @if(session()->has('payment.isMinimum'))
                        <div class='col-md-12'>
                            <strong class='position-relative'>
                                Total a pagar: R${{ number_format(session()->get('payment.toPay'), 2, ',', '.') }} 
                                <i class='fa fa-question-circle font-smaller position-absolute top-0 start-100 translate-middle tooltips' data-toggle="tooltip" data-placement="top" data-html="true" title="Valor arredondado para o pagamento mínimo aceito"></i>
                            </strong>
                        </div><!-- /col-md-12 -->
                    @else
                        <div class='col-md-12'>
                            <strong>Total a pagar: R${{ number_format(session()->get('payment.toPay'), 2, ',', '.') }} </strong> 
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