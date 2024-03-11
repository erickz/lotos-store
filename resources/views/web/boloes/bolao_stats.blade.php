<div class="card card-custom pb-8">
    <div class="card-header ps-0 pe-0">
        <div class="card-title d-flex w-100">
            <div class='mt-3 ms-5'>
                <h4 class=''><b>Relatório de Vendas</b></h4>
            </div> 
            <button type="button" class="close ms-auto me-2" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    </div>

    <div class='container pe-4 ps-4 gamesList mt-4 mb-2'>
        <div class='alert alert-secondary d-flex justify-content-center'>
            <div class='text-center me-9'>
                <span>Nome</span> <br />
                <strong class='font-smaller'>{{ $bolao->name }}</strong>
            </div>
            <div class='text-center me-9'>
                <span>Data do concurso</span> <br />
                <strong class='font-smaller'>{{ $bolao->concurso->getDrawDay() }}</strong>
            </div>
            <div class='text-center'>
                <span>Número de jogos</span> <br />
                <strong class='font-smaller'>{{ $bolao->getQtGames() }}</strong>
            </div>
        </div>

        <div class='mb-2 ms-1'>
            <div>
                <b>Suas cotas:</b> {{ $keptCotas }} cota{{ ($keptCotas > 1 ? 's' : '') }}
            </div>
        </div>

        <div class='mb-2 ms-1'>
            <div>
                <b>Valor da cota:</b> {{ $bolao->getFormattedPrice() }}
            </div>
            <div>
                <b>Total de cotas vendidas:</b> {{ $bolao->buyers->sum('cotas') - $keptCotas }}
            </div>
            <div>
                <b>Receita de vendas do Bolão:</b> <span class='color-default'><b>{{ $bolao->getFormattedProfit() }}</b></span>
            </div
            
        </div>

        <table class='table table-light table-striped text-center mt-3'>
            <thead>
                <tr>
                    <td>Cotas</td>
                    <td>Usuário</td>
                    <td>Data de compra</td>
                </tr>
            </thead>
            <tbody>
                @if($bolao->buyers->count() <= 0)                        
                    <tr class='text-center'>
                        <td colspan='9'>Nenhuma venda realizada ainda</td>
                    </tr>
                @else
                    @foreach($bolao->buyers as $buyer)
                        <tr>
                            <td>{{ $buyer->cotas }}</td>
                            <td>{{ $buyer->customer->getFirstName() }} {!! $buyer->customer_id == auth()->guard('web')->user()->id ? "<span class='text-secondary2'>(Você)</span>" : "" !!}</td>
                            <td>{{ $buyer->getCreatedAtFormatted() }}</td>
                        </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
    </div>
</div>