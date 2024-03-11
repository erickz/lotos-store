<div class="card card-custom pb-8">
    <div class="card-header ps-0 pe-0">
        <div class="card-title d-flex w-100">
            <div class='mt-3 ms-5'>
                <h4><strong>Confirmar compra</strong></h4>
            </div>
            <button type="button" class="close ms-auto me-2" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    </div>

    <form class='container pe-4 ps-4 confirmationInfos mt-4 mx-auto col-md-10'>
        @csrf
        <div class='p-5 bg-secondary border border-light rounded'>
            <div class='d-flex'>
                <div class=''>Nome:</div>
                <strong class='ms-auto'>{{ $bolao->name }}</strong>
            </div>
            <div class='d-flex'>
                <div class=''>Número de jogos:</div>
                <strong class='ms-auto font-larger'>{{ $bolao->getQtGames() }}</strong>
            </div>
            <div class='d-flex'>
                <div class=''>Valor a pagar:</div>
                <strong class='ms-auto font-larger'>{{ $bolao->getFormattedTotalWithCotas($cotasSelected) }}</strong>
            </div>
        </div>

        <div class='bt-containers mt-5 text-center buyHolder'>
            @if(auth()->guard('web')->check())
                <div class='d-block mb-4'>
                    Seu saldo: <strong class='font-larger'>{{ auth()->guard('web')->user()->getFormattedCredits() }}</strong>
                </div>
            @endif
            <div class='alert d-none'></div>
            <div class='d-block'>
                <div class='btn btnBuyCota btn-success' data-url='{{ route("web.boloes.finishbuy", [$bolao->id]) }}' data-cotas='{{ $cotasSelected }}'><i class='fa fa-shopping-cart'></i>Adicionar ao carrinho</div>
            </div>
        </div>
    </form>
</div>