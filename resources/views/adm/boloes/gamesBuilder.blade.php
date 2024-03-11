<div class="bolaoBuilder col-md-12 main-box" data-url='{{ route("adm.boloes.addGame", [$bolao->id]) }}' data-costs='{{ $bolao->lotery->getCostsJson() }}' data-biggestnumber='{{ $bolao->lotery->biggest_number }}' data-minnumber='{{ $bolao->lotery->min_numbers }}' data-maxnumber='{{ $bolao->lotery->max_numbers }}'>
    <h2>Montar Bolão</h2>

    @csrf

    <div class="alert hide">
        {{ session()->get('message') }}
    </div>

    <div class="numberPicker col-md-5 pl-0 ps-0">
        <div class='numbersToSelectCt col-md-12'>
            @for($i = 1; $i <= $bolao->lotery->biggest_number; $i++)
                <span class="number number_{{ $i }}" data-number="{{ $i }}">{{ $i < 10 ? 0 . $i : $i }}</span>
            @endfor
        </div>
        
        <div class='mt-3 col-md-12'>
            <a class="btn btn-primary guessNumber pull-left">
                <i class="fas fa-lightbulb fa-lg"></i> Palpite
            </a>
            <a class="btn btn-primary addBolao pull-left ml-2">
                <i class="fas fa-plus-circle fa-lg"></i> Adicionar jogo
            </a>
            <a class="btn btn-primary cleanBolao pull-left ml-2">
                <i class="fas fa-trash fa-lg"></i> Limpar
            </a>
        </div>
    </div><!-- /bolaoBuilder -->

    <div class="statsCt chosenNumbersCt col-md-6 p-0">
        <div class='progress-bar-level text-center'>
            <h4 class='m-0'>Nível 1 (Regular)</h4>
            <div class='starsCt'>
                <i class="fa fa-star"></i>
            </div>
            <div class=''>
                <span class='mt-1 mb-1'></span>
                <ul class='text-left'></ul>
            </div>
        </div>
        <div class='mb-1'>---</div>
        <div>
            <strong>Número de Dezenas: <span class="dozensNumber">0</span></strong>
        </div>
        <div>
            <strong>Subtotal: R$<span class="bolaoSubtotal">0,00</span></strong>
        </div>
    </div><!-- / -->

    <div class="clearfix mt-3">
        <div class="pull-left mt-0">
            
        </div>
    </div>

    <div class='mt-4'>
        <h2>Apostas 
            <span class='qtGames'>
            @if($bolao->games()->count() > 0) 
                ({{ $bolao->getGamesCount() }})
            @else
                (0)
            @endif
            </span>
        </h2>
        <table class='table games-list' data-url='{{ route("adm.boloes.removeGame") }}'>
            <thead class='thead-dark'>
                <tr>
                    <th>#</th>
                    <th>Números Selecionados</th>
                    <th>Número de Dezenas</th>
                    <th>Custo da aposta</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @if($bolao->games()->count() > 0)
                    @foreach($bolao->games()->orderBy('id', 'DESC')->get() as $game)
                        <tr data-id='{{ $game->id }}'>
                            <td>{{ $game->id }}</td>
                            <td>{{ $game->numbers }}</td>
                            <td>{{ $game->getCountNumbers() }}</td>
                            <td>{{ $game->cost }}</td>
                            <td>
                                <a class="table-link danger removeBolao">
                                    <span class="fa-stack">
                                        <i class="fa fa-square fa-stack-2x"></i>
                                        <i class="fas fa-trash fa-stack-1x fa-inverse"></i>
                                    </span>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
    </div>
</div>