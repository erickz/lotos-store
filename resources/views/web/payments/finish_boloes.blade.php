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
                    <div class='col-lg-12 finishCheckoutMessage mt-5 mb-10 h-180px text-center'>
                        <p>
                            Seu pedido foi concluído e está aguardando pagamento.
                        </p>

                        <p class="overflow-hidden">
                            @if ($payment->type == 'pix')
                                <b>Valido até:</b> {{ $payment->qrCode->getExpirationDate() }}<br />
                                <b>Código pix:</b> {{ $payment->qrCode->codeText }} <br />
                                <img src='{{ $payment->qrCode->imageLink }}' width="200" class="my-4" /> <br />
                            @endif
                        </p>

                        <div class='d-flex justify-content-center mt-5'>
                            <button class='btn btn-primary'><a href='{{ route("web.boloes.customer", [$payment->customer->id, $payment->customer->getProfileNameForURL()]) }}' class='text-white'><b>Veja sua página</b></a></button>
                            <button class='btn btn-success ms-5'><a href='{{ route("web.boloes.create") }}' class='text-white'><b>Crie um novo bolão</b></a></button>
                        </div>
                    </div>
                    <script type='text/javascript'>
                        sessionStorage.setItem('bettings', JSON.stringify([]));
                        sessionStorage.setItem('lotoAlias', '');
                    </script>
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

                            <script type='text/javascript'>
                                sessionStorage.setItem('bettings', JSON.stringify([]));
                                sessionStorage.setItem('lotoAlias', '');
                            </script>
                        @endif

                        <div class='d-flex justify-content-center mt-5'>
                            <button class='btn btn-primary'><a href='{{ route("web.customers.mybuys") }}' class='text-white'><b>Veja suas compras</b></a></button>
                            <button class='btn btn-success ms-5'><a href='{{ route("web.boloes.create") }}' class='text-white'><b>Crie um novo bolão</b></a></button>
                        </div>
                    </div>
                @endif
            </div><!-- /col-lg-12 -->
        </div><!-- /boloesListing -->
    </div><!--end::Container-->
</div><!--end::Entry-->

@endsection