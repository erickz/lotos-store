<h1 class='display-4 text-center border-0 mb-1'><b>Crie seu bolão da {{ $lotery->name }} em 1 minutinho</b></h1>
<div class="mt-4 col-md-12">
    <h2 class='mb-0 border-0'><b>Escolha um modelo e aposte agora:</b></h2>
    <div class='justify-content-center'>
        <div class="d-flex justify-content-between align-items-start d-flex-responsive m-auto">
            @foreach($suggestions->slice(0,4) as $index => $suggestion)
                <div class='bg-white {{ $index < 3 ? 'me-4' : '' }} col py-4 rounded mt-2 border border-secondary w-100'>
                    <h3 class='m-0 p-0 pb-1 border-0 text-center mb-2'><b>{{ $suggestion->name }}</b></h3>
                    
                    @if($index == 2)
                        <div class="text-center">
                            <h3 class='m-0 border-0 mb-2 badge p-2 pb-3 bg-warning'><b><i class="fa fas fa-crown text-white me-1"></i>RECOMENDADO</b></h3>
                        </div>
                    @endif

                    <div class='mt-2'>
                        <div class='mb-4'>
                            <ol class='ps-0 w-75 d-flex flex-column m-auto min-h-50px'>
                                {!! $suggestion->buildDescription() !!}
                            </ol>
                        </div>
                        <div class='text-center mb-4'>
                            <h3 class='border-0'><b>{{ $suggestion->getPrice() }}</b></label>
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
                        <button class='btn btn-primary px-5' href='' data-toggle="modal" data-target="#bolaoSuggestionModal" data-id='{{ $suggestion->id }}' data-url='{{ route("web.boloes.suggestions", [$suggestion->id]) }}'>
                            <b><i class='fa fas fa-search'></i>Simular jogos</b>
                        </button>
                        <button class='btn btnBuySuggestion btn-success px-5' data-url="{{ route('web.boloes.buySuggestion', [$suggestion->id]) }}" data-suggestion="{{ $suggestion->id }}">
                            <b><i class='fa fas fa-shopping-cart'></i>COMPRAR</b>
                        </button>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
<div class="bolaoBuilder text-start mt-10 col-md-12" data-color='{{ $lotery->getColorClass() }}' data-loto-alias="{{ strtolower($lotery->initials) }}" data-costs='{{ $lotery->getCostsJson() }}' data-biggestnumber='{{ $lotery->biggest_number }}' data-minnumber='{{ $lotery->min_numbers }}' data-maxnumber='{{ $lotery->max_numbers }}'>
    <h2 class='border-0 pb-0 mb-1'><b>Ou customize o bolão do seu jeito:</b></h2>
    <div class='alert alert-light ms-0 mb-0'><i class='fas fa-info-circle me-2 text-primary'></i> Selecione seus números da sorte e crie um Bolão <b>(valor mínimo: R$12,50)</b></div>

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
                        <i class='fas fa-dice'></i><b>Gerar apostas</b> 
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

    <div class='text-center mt-8'>
        <h2 class="border-0"><b>Informações do Bolão:</b></h2>
    </div>

    <form action='{{ route("web.boloes.store", strtolower($lotery->initials)) }}' method='POST'>
        @csrf
        <input type='hidden' name='totalToPay' class='inputHdTotalToPay' value='0' />
        <input type='hidden' name='keepCotas' value='1' />
        <b class='cotasCt fade'>0</b><br/>
        <div class='d-flex align-items-center mb-5'>
            <div class='col-4 text-end me-5'>
                <strong class='d-inline'>Concurso: </strong>
            </div>
            <div class='col-6 ps-0'>
                @if ($followingConcursos->count() > 0)
                    <div class='col-12 position-relative'>
                        <select name='concurso_id' id='slConcurso' class='d-inline form-control select'>
                            @foreach($followingConcursos as $concurso)
                                @if($concurso->type == 2)
                                    <option value='{{ $concurso->id }}'>⭐️ {{ $concurso->type == 2 ? $concurso->getSpecialName() : '' }}: Nº{{ $concurso->number }} - {{ $concurso->getDrawDay() }}</option>
                                @else
                                    <option value='{{ $concurso->id }}'>Nº{{ $concurso->number }} - {{ $concurso->getDrawDay() }}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                @else
                    <div class='alert alert-light mb-0 text-center'><i class='fas fa-info-circle me-2 text-primary'></i>Nenhum concurso cadastrado para a próxima semana, por favor tente mais tarde</div>
                @endif
            </div>
        </div>
        <div class='d-flex align-items-center mb-5'>
            <div class='col-4 text-end me-5'>
                <strong>Descrição do Bolão:</strong>
            </div>    
            <div class='col-6'>
                <textarea class="form-control textarea" name="description" placeholder="Digite a descrição do Bolão"></textarea>
            </div>    
        </div>

        <div class='d-flex align-items-center'>
            <select name='price' class='form-control slPrices d-none'>
                @foreach(['7.5', '15', '25', '35', '45', '75', '100', '150', '300', '600', '800', '1000'] as $index => $value)
                    <option value='{{ $value }}' {{ $value == 7.5 ? 'selected="selected"' : '' }}>R${{ str_replace('.', ',', $value) }}</option>
                @endforeach
            </select>
        </div>
        {{--<div class='d-flex align-items-center mb-5'>
            <div class='col-4 text-end me-5'>
                <strong>Total de cotas:</strong> 
            </div>
            <div class='col-6 text-start'>
                <b class='cotasCt'>0</b><br/>
            </div>
        </div>
        <div class='d-flex align-items-center mb-5'>
            <div class='col-4 text-end me-5 position-relative'>
                <strong>Ficar com cotas:</strong>
                <i class='fa fa-question-circle font-smaller position-absolute start-100 translate-middle tooltips' data-toggle="tooltip" data-placement="top" data-html="true" title="Ao escolher nenhuma cota você disponibilizará <b>todas</b> para venda e portanto não será premiado pelas loteria (apenas pela venda das cotas)"></i>
            </div>    
            <div class='col-6'>
                <div class='col-12 position-relative'>
                    <select name='keepCotas' class='form-control slKeepCotas'>
                        <option value='0'>0</option>
                    </select>
                </div>
            </div>    
        </div>--}}
        <div class='d-flex align-items-center mb-5'>
            <div class='col-4 text-end me-5'>
                <strong>Total de jogos:</strong> 
            </div>
            <div class='col-6 text-start'>
                <b class='qtGames'>0</b><br/>
            </div>
        </div>

        <div class='mt-5 col listBets text-center'>
            <div class='lblHolder mb-2'>
                <b class='text-primary'>Seu bolão tem <i class='label label-inline label-primary font-larger px-2 chancesTg'><b>1x MAIS CHANCES</b></i> de ganhar!</b>
            </div>
            <div class='games-list border border-secondary border-dashed p-4' data-url='{{ route("adm.boloes.removeGame") }}' data-chances='{{ $lotery->getChancesJson() }}'>
                <div class='gamesCt max-h-200px overflow-auto'>
                </div>
                <div class='gamesListFooter text-end mt-0'>
                    <div class='text-start'>
                        <div class='alert alert-light ms-0'><i class='fas fa-info-circle me-2 text-primary'></i> Nenhuma aposta adicionada. Escolha seus números da sorte e crie um conjunto de jogos para o seu bolão!</div>
                    </div>
                </div>
            </div>
            
            <div class='finishButton mt-5'>
                <span class='me-3'><strong>Valor mínimo:</strong> R$12,50</span>
                <button type='submit' class="btn-submit btn-finalize btn btn-success ml-2">
                    <b><i class="fas fa-shopping-cart ms-2"></i> Criar Bolão</b>
                </button>        
            </div>
        </div>
    </form>
</div>

{{-- @include('web.boloes.bolao_confirmation_modal') --}}
@include('web.boloes.bolao_suggestion_modal')