@extends('layouts.checkout.checkout')

@section('titlePage', 'Pedido finalizado com sucesso')

@section('content')

<!--begin::Entry-->
<div class="d-flex flex-column-fluid mt-5">
    <!--begin::Container-->
    <div class="container">
        <div class="row boloesListing">
            <div class='col-lg-12'>
                @if ($payment->status == 'DECLINED')
                    <h1 class='ps-0 mb-0 text-secondary text-center mt-10'>Não foi possível realizar o seu pedido</h1>
                    
                    <div class='col-lg-12 finishCheckoutMessage mt-5 mb-10 h-180px text-center'>
                        Seu pedido não pode ser concluido. <br />
                        Por favor, verifique os detalhes do pagamento e tente novamente.

                        <div class='d-flex justify-content-center mt-5'>
                            <button class='btn btn-primary'><a href='{{ route("web.payments.index") }}' class='text-white'><b>Tentar novamente</b></a></button>
                        </div>
                    </div><!-- /col-lg-12 -->
                @elseif($payment->status == 'WAITING')
                    <h1 class='ps-0 mb-0 text-secondary text-center mt-10'>Pedido efetuado com sucesso!</h1>
                    
                    <div class='col-lg-12 finishCheckoutMessage mt-5 mb-10 h-180px text-center'>
                    <p class="text-center">
                            Seu pedido foi concluído e está aguardando pagamento.
                        </p>

                        <p class="overflow-hidden mb-10 text-center">
                            @if ($payment->type == 'pix')
                                <b>Valido até:</b> {{ $payment->qrCode->getExpirationDate() }}<br />
                                <img src='{{ $payment->qrCode->imageLink }}' width="200" class="my-4" /> <br />
                                <button class='btn btn-info' id="copyPixCode" data-code="{{ $payment->qrCode->codeText }}"><i class='fas fa-copy'></i><b>Copiar Código PIX</b></button>
                            @endif
                        </p>

                        <div class="">
                            <p>
                                <h2 class="ps-0">Como Pagar com PIX:</h2>
                                <b>Escaneando o QR Code:</b>
                                <ol>
                                    <li>- Abra o aplicativo do seu banco e acesse a função PIX.</li>
                                    <li>- Selecione a opção "Escanear QR Code" e aponte a câmera do seu celular para o código abaixo.</li>
                                    <li>- Confira os dados e confirme o pagamento.</li>
                                </ol>

                                <b>Copiando e Colando o Código:</b>
                                <ol>
                                    <li>- Clique no botão "Copiar código pix"</li>
                                    <li>- No aplicativo do seu banco, vá até a função PIX e escolha "Colar QR Code".</li>
                                    <li>- Cole o código no campo indicado e finalize a transação.</li>
                                </ol>

                                <b>OBS: Premiações serão notificadas via email</b>
                            </p>
                        </div>

                        <div class='d-flex justify-content-center mt-5'>
                            <button class='btn btn-primary'><a href='{{ route("web.customers.mybuys") }}' class='text-white'><b>Veja suas compras</b></a></button>
                            <button class='btn btn-success ms-5'><a href='{{ route("web.boloes.create") }}' class='text-white'><b>Crie um novo bolão</b></a></button>
                        </div>
                    </div><!-- /col-lg-12 -->
                @else
                    <h1 class='ps-0 mb-0 text-secondary text-center mt-10'>Pedido efetuado com sucesso!</h1>
                    
                    <div class='col-lg-12 finishCheckoutMessage mt-5 mb-10 h-180px text-center'>
                        Seu pedido foi concluído e o pagamento foi confirmado. <br />

                        Em breve, você receberá um e-mail de confirmação contendo com os detalhes da sua compra.

                        <div class='d-flex justify-content-center mt-5'>
                            <button class='btn btn-primary'><a href='{{ route("web.boloes.customer", [$payment->customer->id, $payment->customer->getProfileNameForURL()]) }}' class='text-white'><b>Veja sua página</b></a></button>
                            <button class='btn btn-success ms-5'><a href='{{ route("web.boloes.create") }}' class='text-white'><b>Crie um novo bolão</b></a></button>
                        </div>
                    </div><!-- /col-lg-12 -->
                @endif
            </div><!-- /col-lg-12 -->
        </div><!-- /boloesListing -->
    </div><!--end::Container-->
</div><!--end::Entry-->

@endsection