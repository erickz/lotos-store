<div class="bolaoBuilder col-md-12" data-loto-alias="{{ $lotery->initials }}" data-costs='{{ $lotery->getCostsJson() }}' data-biggestnumber='{{ $lotery->biggest_number }}' data-minnumber='{{ $lotery->min_numbers }}' data-maxnumber='{{ $lotery->max_numbers }}'>
    <h2 class='ps-4'>Montar Bolão: {{ $lotery->name }}</h2>

    @csrf

    <div class='row'>

        <div class="numberPicker col-md-5 pl-0 ps-0">
            <div class='numbersToSelectCt col-md-12'>
                @for($i = 1; $i <= $lotery->biggest_number; $i++)
                    <span class="number number_{{ $i }}" data-number="{{ $i }}">{{ $i < 10 ? 0 . $i : $i }}</span>
                @endfor
            </div>
            
            <div class='mt-3 col-md-12'>
                <div class="btn-group guessNumber">
                    <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
                        <strong><i class="fas fa-lightbulb fa-lg"></i> Palpite</strong> <span class='caret'></span>
                    </button>
                    <ul class="dropdown-menu" role="menu">
                        <!-- @for($i = $lotery->min_numbers; $i <= $lotery->max_numbers; $i++)
                            <li><a>{{ $i }} números</a></li>
                        @endfor -->
                    </ul>
                </div>
                <a class="btn btn-primary addBolao ml-2">
                    <i class="fas fa-plus-circle fa-lg"></i> Adicionar jogo
                </a>
                <a class="btn btn-danger cleanBolao ml-2">
                    <i class="fas fa-trash fa-lg"></i> Limpar
                </a>
            </div>
        </div><!-- /bolaoBuilder -->

        <div class="statsCt chosenNumbersCt col-md-6 p-0">
            <div class='progress-bar-level text-center'>
                <h4 class='d-inline m-0'>Nível 1 - (Regular)</h4>
                <div class='d-inline starsCt mt-2'>
                    <i class="fa fa-star text-primary"></i>
                </div>
                <div class=''>
                    <span class='mt-1 mb-1'></span>
                    <ul class='text-left'></ul>
                </div>
            </div>
            <div class='container ps-0 pe-0 mb-3'>
                <div class='row'>
                    <div class='col-3 mt-3'>
                        <strong class='d-inline text-primary'>Concurso: </strong>
                    </div>
                    <div class='col-5'>
                        <select name='concurso_id' id='slConcurso' class='d-inline form-control select col-md-2'>
                            @foreach($followingConcursos as $concurso)
                                <option value='{{ $concurso->id }}'>{{ $concurso->getDrawDay() }} - Nº {{ $concurso->number }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div><!-- /container -->
            <div class='container ps-0 pe-0 mb-3'>
                <div class='row'>
                    <div class='col-3 mt-3'>
                        <strong class='text-primary'>Preço das cotas:</strong> 
                    </div>
                    <div class='col-3'>
                        <select class='form-control slPrices'>
                            @foreach(['7.5', '15', '25', '35', '45', '75', '100', '150', '300', '600', '800', '1000'] as $index => $value)
                                <option value='{{ $value }}' {{ $value == 7.5 ? 'selected="selected"' : '' }}>R${{ str_replace('.', ',', $value) }}</option>
                            @endforeach
                        </select>
                        <!-- <div class='d-inline'>
                            @foreach(['7.5', '15', '25', '35', '45'] as $index => $value)
                                <span class="label label-square {{ $index == 2 ? 'label-dark' : 'label-success' }}">R${{ str_replace('.', ',', $value) }}</span>
                            @endforeach
                        </div> -->
                    </div>
                </div>
            </div>
            <div class='container ps-0 pe-0'>
                <div class='row'>
                    <div class='col-3'>
                        <strong>Total de cotas:</strong> 
                    </div>
                    <div class='col-9'>
                        <strong class='cotasCt'>0</strong><br/>
                        <div class='messageProfit'><small class='text-dark'>Venda todas as cotas e </small><strong>lucre: <span class='color-default'><u class='profitCt'></u></strong></div>
                    </div>
                </div>
            </div>
            <div class='mb-1'>---</div>
            <div class='container ps-0 pe-0 mb-3'>
                <div class='row'>
                    <div class='col-3'>
                        <strong>Número de Dezenas:</strong> 
                    </div>
                    <div class='col-9'>
                        <span class="dozensNumber">0</span>
                    </div>
                </div>
            </div>
            <div class='container ps-0 pe-0 mb-3'>
                <div class='row'>
                    <div class='col-3'>
                        <strong>Subtotal:</strong>
                    </div>
                    <div class='col-9'>
                        R$<span class="bolaoSubtotal">0,00</span>
                    </div>
                </div>
            </div>
        </div><!-- / -->
    </div>

    <div class='mt-5'>
        <h2 class='ps-4'>Apostas 
            <span class='qtGames'>(0)</span>
        </h2>
        <div class="alert d-none">
            {{ session()->get('message') }}
        </div>
        <table class='table table-light table-striped text-center games-list' data-url='{{ route("adm.boloes.removeGame") }}'>
            <thead class='thead-dark'>
                <tr>
                    <th>#</th>
                    <th>Números Selecionados</th>
                    <th>Número de Dezenas</th>
                    <th>Custo da aposta</th>
                    <th><a class="table-link danger removeAllBoloes cursor-p" title='Remover Todos'><span class="fa-stack"><i class="fa fa-square text-danger fa-stack-2x"></i><i class="fas fa-trash fa-stack-1x fa-inverse"></i></span></a></th>
                </tr>
            </thead>
            <tbody>
                <tr class='text-center'>
                    <td colspan='5'>Você ainda não fez nenhuma aposta. Crie uma agora e convide seus amigos para jogar!</td>
                </tr>
            </tbody>
            <tfoot>
            </tfoot>
        </table>

        <div class='finishButton'>
            <span class='me-3'><strong>Valor mínimo:</strong> R$45,00</span>
            <button type="button" class="btn btn-success ml-2" data-toggle="modal" data-target="#bolaoConfirmationModal">
                <i class="fas fa-check fa-lg"></i> Finalizar Bolão
            </button>
        </div>
    </div>
</div>

@include('web.boloes.bolao_confirmation_modal')

