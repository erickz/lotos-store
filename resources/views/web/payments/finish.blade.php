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
                    <h1 class='ps-0 mb-0 text-secondary text-center mt-10'>Não foi possível realizar o seu pedido ❌</h1>
                    
                    <div class='col-lg-12 finishCheckoutMessage mt-5 mb-10 h-180px text-center'>
                        Seu pedido não pode ser concluido. <br />
                        Por favor, verifique os detalhes do pagamento e tente novamente.

                        <div class='d-flex justify-content-center mt-5'>
                            <button class='btn btn-primary'><a href='{{ route("web.payments.index") }}' class='text-white'><b>Tentar novamente</b></a></button>
                        </div>
                    </div><!-- /col-lg-12 -->
                @else
                    <h1 class='ps-0 mb-0 text-secondary text-center mt-10'>Pedido efetuado com sucesso 👍🏽</h1>
                    
                    <div class='col-lg-12 finishCheckoutMessage mt-5 mb-10 h-180px text-center'>
                        Seu pedido foi concluído e o pagamento foi confirmado. <br />

                        Em breve, você receberá um e-mail de confirmação contendo com os detalhes da sua compra.

                        <div class='d-flex justify-content-center mt-5'>
                            <button class='btn btn-primary'><a href='{{ route("web.boloes.listing") }}' class='text-white'><b>Participe dos bolões</b></a></button>
                            <button class='btn btn-success ms-5'><a href='{{ route("web.boloes.create") }}' class='text-white'><b>Crie um novo bolão</b></a></button>
                        </div>
                    </div><!-- /col-lg-12 -->
                @endif
            </div><!-- /col-lg-12 -->
        </div><!-- /boloesListing -->
    </div><!--end::Container-->
</div><!--end::Entry-->

@endsection