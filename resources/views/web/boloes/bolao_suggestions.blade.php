<div class="card card-custom pb-6">
    <div class="card-header ps-0 pe-0">
        <div class="card-title d-flex justify-content-between w-100">
            <div class='mt-3 ms-5'>
                <h4 class='text-uppercase'>
                    <b class='d-flex'><span class='mt-1'>{{ $suggestion->name }} da {{ $lotery->name }}</span></b>
                </h4>
            </div>
            <button type="button" class="close ms-6 me-2" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    </div>

    <form class='container p-4 gamesList' method='POST' action='{{ route("web.boloes.store", [strtolower($suggestion->lotery->initials)]) }}'>   
        @csrf

        <input type='hidden' name='price' value='{{ $suggestion->price_cota }}' />
        <input type='hidden' name='totalToPay' value='{{ $suggestion->price }}' />
        <input type='hidden' name='qtCotas' value='{{ $suggestion->cotas }}' />
        <input type='hidden' name='keepCotas' value='{{ $suggestion->keepCotas }}' />
        
        @foreach($games as $game)
            <input type='hidden' name='games[]' value='{{ implode(",", $game) }}' />
        @endforeach

        <div class='mb-2'>
            <b class='text-primary'>
                <i class='label label-inline label-primary font-larger px-2 py-1 chancesTg'>
                    <b>{{ $suggestion->chances }}x MAIS CHANCES</b>
                </i> 
                DE GANHAR!
            </b>
        </div>
        <div class='d-flex align-items-center mb-2'>
            <div class='col-12 text-start me-5'>
                <strong class='d-inline'>Concurso: </strong>

                @if ($followingConcursos->count() > 0)
                    <div class='col-12 position-relative'>
                        <select name='concurso_id' id='slConcurso' class='d-inline form-control select'>
                            @foreach($followingConcursos as $concurso)
                                @if($concurso->type == 2)
                                    <option value='{{ $concurso->id }}'>⭐️ {{ $concurso->type == 2 ? $concurso->getSpecialName() : '' }}: Nº{{ $concurso->number }} - {{ $concurso->getDrawDay() }}</option>
                                @else
                                    <option value='{{ $concurso->id }}'>Nº{{ $concurso->number }} - {{ $concurso->getDrawDay() }} | {{ $concurso->getFormattedNextExpectedPrize() }}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                @else
                    <div class='alert alert-light mb-0 text-center'><i class='fas fa-info-circle me-2 text-primary'></i>Nenhum concurso cadastrado para a próxima semana, por favor tente mais tarde</div>
                @endif
            </div>
        </div> 
        <div class='mb-2'>
            <b>Descrição: </b>
            <ol class='ps-4 d-flex flex-column m-auto'>
                @foreach( $suggestion->getBets() as $index => $bet )
                    <li class=''><span>{!! '<b>' . $bet . '</b> aposta' . ($bet > 1 ? 's ' : ' ') . 'de ' !!}</span>  <b class='text-primary'>{!! $index . ' dezenas' !!}</b></li>
                @endforeach
            </ol>
        </div>
        <div class="">
            <?php 
            $num = sprintf("%04d", 1);
            ?>
            <h5 class='text-secondary ps-0'><b>{{ count($games) }} Jogos:</b></h5>
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

        <div class='px-4 py-0 mb-2 mt-2 ps-0 font-larger'>
            <b>Preço: </b><b>{{ $suggestion->getPrice() }}</b>
        </div>

        <div class='p-4 pb-0 px-0'>
            <button type='' class='btn btn-lg btn-success w-100'><b><i class='fas fa-shopping-cart'></i>APOSTAR PALPITES</b></button>
        </div>
    </form>    
</div>