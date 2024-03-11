<div class="card card-custom pb-6">
    <div class="card-header ps-0 pe-0">
        <div class="card-title d-flex justify-content-between w-100">
            <div class='mt-3 ms-5'>
                <h4 class='text-uppercase'>
                    <b class='d-flex'><i class='iconMg me-2'></i> <span class='mt-1'>{{ $suggestion->name }} da Mega da Virada</span></b>
                </h4>
            </div>
            <button type="button" class="close ms-6 me-2" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    </div>

    <form method='POST' action='{{ route("web.boloes.store", [strtolower($suggestion->lotery->initials)]) }}' class='container p-0 gamesList'>   
        @csrf

        <input type='hidden' name='concurso_id' value='{{ $concurso->id }}' />
        <input type='hidden' name='price' value='{{ $suggestion->price_cota }}' />
        <input type='hidden' name='totalToPay' value='{{ $suggestion->price }}' />
        <input type='hidden' name='qtCotas' value='{{ $suggestion->cotas }}' />
        
        @foreach($games as $game)
            <input type='hidden' name='games[]' value='{{ implode(",", $game) }}' />
        @endforeach

        <ul class="p-4 nav nav-tabs nav-tabs-line mt-2 d-flex justify-content-center">
            <li class="nav-item col">
                <a class="nav-link active border-0 p-0 d-block text-center" data-toggle="tab" href="#kt_tab_pane_1"><b>INFORMAÇÕES DO BOLÃO</b></a>
            </li>
            <li class="nav-item col">
                <a class="nav-link border-0 p-0 d-block text-center" data-toggle="tab" href="#kt_tab_pane_2"><b>JOGOS</b></a>
            </li>
        </ul>
        <div class="tab-content p-4 pb-0" id="myTabContent">
            <div class="tab-pane fade show active" id="kt_tab_pane_1" role="tabpanel" aria-labelledby="kt_tab_pane_2">
                <div class='mb-2'>
                    <b class='text-danger'>
                        <i class='label label-inline  label-danger font-larger px-2 py-1 chancesTg'>
                            <b>{{ $suggestion->chances }}x MAIS CHANCES</b>
                        </i> 
                        DE GANHAR!
                    </b>
                </div>
                <div class='mb-2'>
                    <b>Quantidade de Jogos:</b> {{ $suggestion->qt_bets }} apostas
                </div>
                <div class='mb-2'>
                    <b>Descrição: </b>
                    <ol class='ps-4 d-flex flex-column m-auto min-h-50px'>
                        @foreach( $suggestion->getBets() as $index => $bet )
                            <li class=''><span>{!! '<b>' . $bet . '</b> aposta' . ($bet > 1 ? 's ' : ' ') . 'de ' !!}</span>  <b class='text-primary'>{!! $index . ' dezenas' !!}</b></li>
                        @endforeach
                    </ol>
                </div>
                <div class='separator separator-dashed mt-4 separator-border-2 separator-secondary'></div>
                <div class='mt-4'>
                    <span>Deseja listar o seu bolão no nosso site para venda?</span> <br />
                    <div class='separator separator-primary'></div>
                    <span id='tgOpenSellBolao' class="switch switch-success switch-outline switch-icon switch-brand">
                        <label>
                            <input type="checkbox" name="display_for_selling" value='1'>
                            <span></span>
                        </label>
                    </span>
                    <div id='sellPanel' class="border border-secondary p-4 pb-0 rounded"> 
                        <div class='d-flex align-items-center mb-5'>
                            <div class='col-4 text-start me-5'>
                                <strong>Ficar com cotas:</strong>
                            </div>    
                            <div class='col-6'>
                                <div class='col-10 position-relative'>
                                    <select name='keepCotas' class='form-control slKeepCotas'>
                                        <option value='0'>Nenhuma Cota</option>

                                        @for($i = 1; $i <= $suggestion->cotas; $i++)
                                            <option value='{{ $i }}' {{ $i == 1 ? 'selected="selected"' : '' }}>{{ $i }} cota{{ $i > 1 ? "s" : '' }}</option>
                                        @endfor
                                    </select>
                                </div>
                            </div>    
                        </div>
                        <div class='d-flex align-items-center mb-5'>
                            <div class='col-4 text-start me-5'>
                                <strong class='position-relative'>
                                    Receita estimada:
                                </strong>
                            </div>    
                            <div class='col-3'>
                                <div class='messageProfit font-larger'>
                                    <b class='color-default revenueCt'>{{ $suggestion->getReceipt() }}</b> 
                                </div>
                            </div>    
                        </div>    
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="kt_tab_pane_2" role="tabpanel" aria-labelledby="kt_tab_pane_2">
                <?php 
                $num = sprintf("%04d", 1);
                ?>
                <h5 class='text-secondary ps-0'><b>{{ count($games) }} Apostas:</b></h5>
                <ul class='list ps-1 max-h-150px overflow-auto'>
                    @foreach($games as $game)
                        <li class='mb-2 d-flex'>
                            <span class='min-w-45px'>
                                <strong class='id-game mt-2 d-inline-block'>{{ sprintf("%04d", $num++) }}</strong> - 
                            </span>
                            <span class='col ms-2'>
                                @foreach($game as $number)
                                    <span class='d-inline-block number bg-light text-{{ $suggestion->lotery->getColorClass() }} border border-{{ $suggestion->lotery->getColorClass() }} rounded rounded-circle w-35px text-center p-2 mb-1'><b>{{ str_replace(',', '', sprintf("%02d", $number)) }}</b></span>
                                @endforeach
                            </span>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>

        <div class='px-4 py-0 mb-2 mt-2'>
            <b>Preço: </b><label class='label label-inline label-lg label-primary'><b>{{ $suggestion->getPrice() }}</b></label>
        </div>

        <div class='p-4 pb-0'>
            <button type='' class='btn btn-lg btn-success w-100'><b><i class='fas fa-lock'></i>COMPRAR AGORA</b></button>
        </div>
    </form>    
</div>