<div class="card card-custom pb-8">
    <div class="card-header ps-0 pe-0">
        <div class="card-title d-flex w-100">
            <div class='mt-3 ms-5'>
                <h4 class='text-uppercase'>
                    <b class='d-flex'>
                        @if($bolao->concurso->type == 2 && $bolao->lotery_id == 1)
                            <i class='iconMg me-2'></i> 
                        @endif
                        <span class='mt-1'>{{ $bolao->concurso->type == 2 ? $bolao->concurso->getSpecialName() : $bolao->lotery->name }} </span>
                    </b>
                </h4>
            </div> 
            <div class='bolao-contest mt-3 ms-auto'>
                <h4>
                    <b>Concurso: Nº {{ $bolao->concurso->number }}</b>
                </h4>
            </div>
            <button type="button" class="close ms-6 me-2" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    </div>

    <div class='container pe-4 ps-4 gamesList mt-4'>
        <div class='alert alert-secondary d-flex justify-content-center'>
            <div class='text-center me-9'>
                <span>Nome</span> <br />
                <strong class='font-larger'>{{ $bolao->name }}</strong>
            </div>
            <div class='text-center me-9'>
                <span>Data do concurso</span> <br />
                <strong class='font-larger'>{{ $bolao->concurso->getDrawDay() }}</strong>
            </div>
            <div class='text-center'>
                <span>Quantidade de apostas</span> <br />
                <strong class='font-larger'>{{ $bolao->getQtGames() }}</strong>
            </div>
        </div><!-- /alert -->

        <div class='mb-2 ms-1'>
            <!-- <div class='border border-secondary mb-3'></div> -->
            <div class='badge badge-primary mb-3 bg-info text-white cursor-p pb-2 printButton'><i class='fas fa-receipt text-white me-2'></i><span class='font-larger'>Imprimir</span></div>
        </div>

        <div class='mb-2'>
            {!! $bolao->getLblChances() !!}
        </div>
        <div class='mb-4 ms-1'>
            <span>Prêmiação estimada:</span> <strong class='font-larger color-default position-relative'>{!! $bolao->concurso->getNextExpectedPrize() !!}</strong>
        </div>

        <?php 
        $num = sprintf("%04d", 1);
        ?>
        <ul class='list mb-0 ps-2'>
            @foreach($games as $game)
                <li class='mb-2 d-flex'>
                    <span class=''>
                        <strong class='id-game d-inline-block mt-2'>{{ sprintf("%04d", $num++) }}</strong> - 
                    </span>
                    <span class='col ms-2'>
                        @foreach(explode(',', $game->numbers) as $number)
                            <span class='number bg-light border border-{{ $bolao->lotery->getColorClass() }} rounded rounded-circle w-35px text-center p-2 mb-1 d-inline-block {{ $game->prized ? "bg-success text-white" : "text-" . $bolao->lotery->getColorClass() }}'><b>{{ str_replace(',', '', sprintf("%02d", $number)) }}</b></span>
                        @endforeach
                        @if($game->prized)
                            <span class=''><b class="text-success"><i class="fas fa-star text-success"></i> Premiado:</b> {{ $game->getFormattedPrize() }}</span>
                        @endif
                    </span>
                </li>
            @endforeach
        </ul>

        @if ($bolao->isValidToBuy())

            <div class='mb-2 mt-4'>
                <div class='border border-secondary'></div>
            </div>

            <div class='shareButtons onGamesModal text-left'>
                {!! $bolao->buildShareButtons() !!}
            </div>

            <form class='bt-containers mt-5'>
                @csrf
                <div class='alert d-none'></div>
                
                <div class='d-flex align-items-center'>
                    <div class=''>
                        @if(auth()->guard('web')->check())
                            <div>
                                Seu saldo: <strong class='font-larger creditsUser' data-value="{{ auth()->guard('web')->user()->credits }}">{{ auth()->guard('web')->user()->getFormattedCredits() }}</strong>
                            </div>
                            <div>
                                Valor a pagar: <strong class='font-smaller calculateTotal' data-price='{{ $bolao->price }}'>R$0,00</strong>
                            </div>
                        @else
                            <div>
                                Valor a pagar: <strong class='font-smaller calculateTotal' data-price='{{ $bolao->price }}'>R$0,00</strong>
                            </div>
                        @endif
                    </div>
                    <div class='d-flex ms-auto buyHolder'>
                        <div class='slHolder me-1'>
                            <select name='cotas' class='form-control slChooseCotas'>
                                @for($i = 0; $i <= $bolao->getAvailableCotas(); $i++)
                                    <option value='{{ $i }}'>{{ $i }}</option>
                                @endfor
                            </select>
                        </div>
                        <div class='btn btnBuyCota btnBuyValidate btn-success ms-auto resetBuy disabled' data-url='{{ route("web.boloes.finishbuy", [$bolao->id]) }}'><i class='fa fa-shopping-cart'></i>Comprar</div>
                    </div>
                </div>
            </form>
        @endif
    </div>
</div>