<div class="bolaoBuilder text-center mt-10 col-md-12" data-color='{{ $lotery->getColorClass() }}' data-loto-alias="{{ strtolower($lotery->initials) }}" data-costs='{{ $lotery->getCostsJson() }}' data-biggestnumber='{{ $lotery->biggest_number }}' data-minnumber='{{ $lotery->min_numbers }}' data-maxnumber='{{ $lotery->max_numbers }}'>
    <h1 class='ps-0 mb-5'><b>Novo Bolão da {{ $lotery->name }}</b></h1>

    @csrf

    <div class='justify-content-center'>
        <div class='alert alert-light ms-0 mb-0'><i class='fas fa-info-circle me-2 text-primary'></i> Selecione seus números da sorte e crie um Bolão <b>(o valor mínimo é R$12,00)</b></div>

        {{--<h2 class="border-0 text-start mb-0 mt-3"><b>Modelos pré-prontos</b></h2>
        <div class="d-flex justify-content-between align-items-start d-flex-responsive m-auto">
            @foreach($suggestions->slice(0,4) as $index => $suggestion)
                <div class='bg-white {{ $index < 3 ? 'me-4' : '' }} col py-4 rounded mt-2 border border-secondary'>
                    <h3 class='m-0 p-0 pb-1 border-0 text-center mb-2'><b>{{ $suggestion->name }}</b></h3>

                    <div class='mt-2'>
                        <div class='mb-4'>
                            <ol class='ps-0 w-75 d-flex flex-column m-auto min-h-50px'>
                                @foreach( $suggestion->getBets() as $index => $bet )
                                    <li class='w-75 m-auto d-flex justify-content-center'><span>{!! '<b>' . $bet . '</b> aposta' . ($bet > 1 ? 's ' : ' ') . 'de ' !!}</span>  <b class='ms-1'>{!! $index . ' dezenas' !!}</b></li>
                                @endforeach
                            </ol>
                        </div>
                        <div class='text-center mb-4'>
                            <b>Preço:</b> <label class='label label-inline bg-success text-white label-lg'><b>{{ $suggestion->getPrice() }}</b></label>
                        </div>
                        <div class='text-center mb-4'>
                            <b class='text-success'>
                                <i class='label label-inline label-success font-larger px-2'>
                                    <b>{{ $suggestion->chances }}x MAIS CHANCES</b>
                                </i>
                                <br /> 
                                DE GANHAR!
                            </b>
                        </div>
                    </div>

                    <div class='footerBox mt-2 text-center'>
                        <button class='btn btn-lg btn-success px-5 font-larger' href='' data-toggle="modal" data-target="#bolaoSuggestionModal" data-id='{{ $suggestion->id }}' data-url='{{ route("web.boloes.suggestions", [$suggestion->id]) }}'><b>SIMULAR BOLÃO</b></button>
                    </div>
                </div>
            @endforeach
        </div>--}}
    </div>

    <!-- <div class="border mt-6 p-0"></div> -->

    <div class='justify-content-center'>

        <div class='d-flex d-flex-responsive justify-content-center m-auto'>

            <div class="col numberPicker col-md-5 text-center mt-4 mb-2 border rounded border-dash p-4">
                <h3 class='ps-0 border-0 mb-4 text-start'><b>Selecionar meus números</b></h3>
                <div class="statsCt chosenNumbersCt p-0 mt-8 mb-5 pb-2">
                    <div class='container ps-0 pe-0 mb-3'>
                        <div class='row'>
                            <div class='col-4 text-start'>
                                <strong>Número de Dezenas:</strong> 
                            </div>
                            <div class='col-8 ps-0'>
                                <span class="dozensNumber">0</span>
                            </div>
                        </div>
                    </div>
                    <div class='container ps-0 pe-0 mb-3'>
                        <div class='row d-flex justify-content-start'>
                            <div class='col-4 mt-3 text-start'>
                                <strong class='d-inline'>Dezenas selecionadas: </strong>
                            </div>
                            <div class='col-7 p-0 position-relative'>
                                <input type='text' disabled='disabled' class='w-100 border border-2 rounded mt-2 selectedDozens ps-2 max-h-30px' />
                            </div>
                        </div>
                    </div><!-- /container -->
                    <div class='container ps-0 pe-0 mb-3'>
                        <div class='row'>
                            <div class='col-4 text-start'>
                                <strong>Subtotal:</strong>
                            </div>
                            <div class='col-8 ps-0'>
                                R$<span class="bolaoSubtotal">0,00</span>
                            </div>
                        </div>
                    </div>
                </div><!-- / -->
                <div class='numbersToSelectCt col-md-12 p-0 text-start d-flex'>
                    @for($i = 1; $i <= $lotery->biggest_number; $i++)
                        <span class="number number_{{ $i }} border-{{ $lotery->getColorClass() }} text-{{ $lotery->getColorClass() }} rounded-circle pt-1 pe-1 ps-1 pb-1 me-2 mt-2" data-number="{{ $i }}"><b>{{ $i < 10 ? 0 . $i : $i }}</b></span>
                    @endfor
                </div>
                <div class='w-100'>
                    <!-- <div class="btnHolder dropdown guessNumber me-1 mt-2">
                        <button type="button" class="btn btn-primary dropdown-toggle w-100 text-start d-flex justify-content-between" data-toggle="dropdown">
                            <span>
                                <i class="fas fa-gift fa-lg"></i>
                            </span>
                            <strong>
                                Surpresinha
                            </strong>
                            <span class=''>
                                <i class='fas fa-caret-up'></i>
                            </span>
                        </button>
                        <ul class="dropdown-menu" role="menu"></ul>
                    </div> -->
                </div>
                <div class='btCt mt-3 d-flex align-items-between'>
                    <div class="btn btn-success addBolao me-1">
                        <strong class='d-block'><i class="fas fa-plus-circle fa-lg"></i> Adicionar Números</strong>
                    </div>
                    <div class="btn btn-secondary cleanBolao">
                        <strong class='d-block'><i class="fas fa-broom fa-lg"></i> Limpar</strong>
                    </div>
                </div>
            </div><!-- /bolaoBuilder -->

            <div class='col generateNumbersCt mt-4 ms-2 border rounded border-dash p-4'>
                <h3 class='ps-0 border-0 mb-4 text-start'><b>Gerar jogos</b></h3>
                <div class='d-flex justify-content-start align-items-center'>
                    <div class='slHolder max-w-80px'>
                        <select class='form-control numbersDozens'>
                            @for($i = $lotery->min_numbers; $i <= $lotery->max_numbers; $i++)                    
                                <option value='{{ $i }}'>{{ $i }}</option>
                            @endfor
                        </select>
                    </div>
                    <div class='ms-2'>
                        Quantidade de dezenas
                    </div>
                </div>
                <div class='d-flex justify-content-start align-items-center mt-2'>
                    <div class='slHolder max-w-80px'>
                        <select class='form-control slQtGames'>
                            @for($i = 1; $i <= 10; $i++)                    
                                <option value='{{ $i }}'>{{ $i }}</option>
                            @endfor
                        </select>
                    </div>
                    <div class='ms-2'>
                        Quantidade de jogos
                    </div>
                </div>
                <div class='text-start mt-2'>
                    <button class='btn btn-lg btn-primary btGenerate'>
                        <i class='fas fa-dice'></i><b>Criar jogos</b> 
                    </button>
                </div>
                <div class='text-start mt-2'>
                    <button class='btn btn-lg btn-warning btGenerate' data-dozens="{{ $lotery->costs->first()->number_matches + 1 }}">
                        <i class='fas fa-star'></i><b>Criar 1 aposta de {{ $lotery->costs->first()->number_matches + 1 }} dezenas</b> 
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div class='mt-10 listBets'>
        <h2 class='ps-4 border-0 mb-2'><b>Jogos 
            <span class='qtGames'>(0)</span>
            </b>
        </h2>
        <div class='lblHolder mb-2'>
            <b class='text-primary'>Seu bolão tem <i class='label label-inline label-primary font-larger px-2 chancesTg'><b>MAIS CHANCES</b></i> de ganhar!</b>
        </div>
        <div class="alert d-none">
            {{ session()->get('message') }}
        </div>

        <div class='games-list border border-secondary border-dashed p-4' data-url='{{ route("adm.boloes.removeGame") }}' data-chances='{{ $lotery->getChancesJson() }}'>
            <div class='gamesCt max-h-200px overflow-auto'>
            </div>
            <div class='gamesListFooter text-end mt-2 me-4'>
                <div class='text-start'>
                    <div class='alert alert-light ms-0'><i class='fas fa-info-circle me-2 text-primary'></i> Nenhuma aposta adicionada. Escolha seus números da sorte e crie um conjunto de jogos para o seu bolão!</div>
                </div>
            </div>
        </div>

        <div class='finishButton mt-5'>
            <form action='{{ route("web.boloes.finalize", [$lotery->initials]) }}' method='POST'>
                @csrf
                <input type='hidden' name='totalToPay' class='inputHdTotalToPay' value='0' />

                <span class='me-3'><strong>Valor mínimo:</strong> R$12,50</span>
                <button type='submit' class="btn-submit btn btn-success ml-2">
                    <b>Prosseguir <i class="fas fa-chevron-right fa-lg ms-2"></i></b>
                </button>
            </form>
        </div>
    </div>
</div>

{{-- @include('web.boloes.bolao_confirmation_modal') --}}