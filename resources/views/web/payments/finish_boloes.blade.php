@extends('layouts.checkout.checkout')

@section('titlePage', 'Pedido finalizado com sucesso')

@section('content')

<!--begin::Entry-->
<div class="d-flex flex-column-fluid mt-5">
    <!--begin::Container-->
    <div class="container">
        <div class="row boloesListing">
            <div class='col-lg-12'>
                @if ($customBolao)
                    @if (isset($error) && $error)
                        <h1 class='ps-0 mb-0 text-secondary text-center mt-10'>Não foi possível completar a criação do Bolão ❌</h1>
                    @else
                        <h1 class='ps-0 mb-0 text-secondary text-center mt-10'>Bolão criado com sucesso 🌟</h1>
                    @endif
                @else
                    @if (isset($error) && $error)
                        <h1 class='ps-0 mb-0 text-secondary text-center mt-10'>Não foi possível completar a criação do Bolão ❌</h1>
                    @else
                        <h1 class='ps-0 mb-0 text-secondary text-center mt-10'>Cotas compradas com sucesso 🌟</h1>
                    @endif
                @endif
                
                <div class='col-lg-12 finishCheckoutMessage mt-5 mb-10 h-180px text-center'>
                    @if ($customBolao)
                        @if (isset($error) && $error)
                            Seu pedido não pode ser criado. <br />
                            Tente novamente mais tarde, caso o problema persista entre <a href='{{ route("web.staticPages.contact") }}'>em contato</a> com o nosso suporte
                        @else
                            Convide outros jogadores para comprar cotas e participar! <br />
                            Que a sorte esteja ao seu lado! 🍀

                            <div class='d-flex justify-content-center mt-5'>
                                <a href='{{ route("web.customers.bets") }}' class='btn btn-primary text-white'><b>Visualizar minhas apostas</b></a>
                            </div>
                        @endif

                        <script type='text/javascript'>
                            sessionStorage.removeItem('bettings');
                            sessionStorage.removeItem('lotoAlias');
                        </script>
                    @else
                        @if (isset($error) && $error)
                            Seu pedido não pode ser criado. <br />
                            Tente novamente mais tarde, caso o problema persista <a href='{{ route("web.staticPages.contact") }}'>entre em contato</a> com o nosso suporte
                        @else
                            Sua compra foi realizada com sucesso! <br />
                            Agradecemos a participação e desejamos muita sorte 🍀

                            <div class='d-flex justify-content-center mt-5'>
                                <a href='{{ route("web.customers.mybuys") }}' class='btn btn-primary text-white'><b>Visualizar minhas compras</b></a>
                            </div>
                        @endif
                    @endif
                </div><!-- /col-lg-12 -->
            </div><!-- /col-lg-12 -->
        </div><!-- /boloesListing -->
    </div><!--end::Container-->
</div><!--end::Entry-->

@endsection