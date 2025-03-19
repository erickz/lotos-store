@extends('layouts.checkout.checkout')

@section('titlePage', 'Pedido finalizado com sucesso')

@section('content')

<!--begin::Entry-->
<div class="d-flex flex-column-fluid mt-5">
    <!--begin::Container-->
    <div class="container">
        <div class="row boloesListing overflow-hidden">
            <div class='col-lg-12'>
                @if (isset($payment) && $payment->type == 'pix')
                    <h1 class='ps-0 mb-0 text-secondary text-center mt-10'>Pedido realizado com sucesso!</h1>
                    <div class='col-lg-12 finishCheckoutMessage mt-5 mb-10 h-180px'>
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
                        @if($customBolao)
                                <button class='btn btn-primary'><a href='{{ route("web.customers.bets") }}' class='text-white'><b>Veja seus Bolões</b></a></button>
                            @else
                                <button class='btn btn-primary'><a href='{{ route("web.customers.mybuys") }}' class='text-white'><b>Veja suas compras</b></a></button>
                            @endif
                            <button class='btn btn-success ms-5'><a href='{{ route("web.boloes.create") }}' class='text-white'><b>Crie um novo bolão</b></a></button>
                        </div>
                    </div>
                @else
                    @if (isset($error) && $error)
                        <h1 class='ps-0 mb-0 text-secondary text-center mt-10'>Houve algo inesperado durante a realização da compra</h1>
                    @else
                        <h1 class='ps-0 mb-0 text-secondary text-center mt-10'>Pedido Realizado com sucesso</h1>
                    @endif

                    <div class='col-lg-12 finishCheckoutMessage mt-5 mb-10 h-180px text-center'>
                        @if (isset($error) && $error)
                            Tente novamente mais tarde, caso o problema persista entre <a href='{{ route("web.staticPages.contact") }}'>em contato</a> com o nosso suporte
                        @else
                            Sua compra foi realizada com sucesso! <br />
                            Agradecemos a participação e desejamos muita sorte 🍀
                        @endif

                        <div class='d-flex justify-content-center mt-5'>
                            @if($customBolao)
                                <button class='btn btn-primary'><a href='{{ route("web.customers.bets") }}' class='text-white'><b>Veja seus Bolões</b></a></button>
                            @else
                                <button class='btn btn-primary'><a href='{{ route("web.customers.mybuys") }}' class='text-white'><b>Veja suas compras</b></a></button>
                            @endif
                            <button class='btn btn-success ms-5'><a href='{{ route("web.boloes.create") }}' class='text-white'><b>Crie um novo bolão</b></a></button>
                        </div>
                    </div>
                @endif
            </div><!-- /col-lg-12 -->
        </div><!-- /boloesListing -->
    </div><!--end::Container-->
</div><!--end::Entry-->

@endsection