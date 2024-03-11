@extends('layouts.web.web')

@section('titlePage', 'Crie seu Próprio Bolão de Loteria aqui na ' . env('APP_NAME') . '!')
@section('descriptionPage', 'Monte seu próprio bolão de loteria e aumente suas chances de vitória. 
Compartilhe e venda suas apostas, maximize as possibilidades e celebre prêmios. Crie seu bolão agora!')

@section('content')

<div class="d-flex flex-column-fluid mt-5" id='bolaoFinalize'>
    <!--begin::Container-->
    <div class="container">
        <div class="col-lg-12">
            <div class="main-box clearfix">                
                <div class="row profile-user-info">
                    @include('web.boloes.wizard.menu_steps')

                    <form method='POST' action='{{ route("web.boloes.store", strtolower($lotery->initials)) }}' class='formFinalize'>
                        @csrf
                        <input type='hidden' name='totalToPay' class='inputHdTotalToPay' value='0' />
                        <div class='mt-3'>
                            <div class="alert border mb-4 ps-2 pe-3" role="alert">
                                <div class="alert-icon d-inline">
                                    <i class="fas fa-info-circle fa-fw fa-lg text-primary"></i>
                                </div>
                                <div class="text-primary d-inline">Confirme as opções desejadas e finalize o bolão</div>
                            </div>
                            <div class='mb-5'>
                                <h2>Resumo</h2>
                            </div>
                            <div class='d-flex align-items-center mb-5'>
                                <div class='col-4 text-end me-5'>
                                    <strong>Loteria:</strong>
                                </div>    
                                <div class='col-6'>
                                    <span class=''><label class='text-{{ $lotery->getColorClass() }}'><b>{{ $lotery->name }}</b></label></span>
                                </div>    
                            </div>
                            <div class='d-flex align-items-center mb-5'>
                                <div class='col-4 text-end me-5'>
                                    <strong>Nome do bolão:</strong> 
                                </div>
                                <div class='col-6'>
                                    <span class='p-2 badge badge-success bg-success text-white luckyBird'><b>{{ $luckBird }}</b></span>
                                    <input type='hidden' name='luckBird' value='{{ $luckBird }}' /><br />
                                    <small>O nome do seu bolão é gerado automaticamente com um pássaro da sorte</small>
                                </div>
                            </div>
                            <div class='d-flex align-items-center mb-5'>
                                <div class='col-4 text-end me-5'>
                                    <strong class='d-inline'>Selecione o concurso: </strong>
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
                            </div><!-- /container -->
                            <div class='d-flex align-items-center mb-5'>
                                <div class='col-4 text-end me-5'>
                                    <strong class='d-inline'>Deseja listar o seu bolão no nosso site para venda?</strong>
                                </div>
                                <div class='col-6 ps-0'>
                                    <div class='separator separator-primary'></div>
                                    <span id='tgOpenSellBolao' class="switch switch-success switch-outline switch-icon switch-brand">
                                        <label>
                                            <input type="checkbox" name="display_for_selling" value='1'>
                                            <span></span>
                                        </label>
                                    </span>
                                </div><!-- /col -->
                            </div><!-- /d-flex -->
                            <div id='sellPanel' class="border border-secondary p-4 pb-0 rounded"> 
                                <div class='col-md-3 m-auto text-center mb-5'>
                                    <h3 class='bg-light p-2 rounded'>
                                        <div class='text-secondary2'>
                                            <b><span class='min-w-50px me-2'>Pague</span> <span class='font-smaller text-secondary costCt'></span></b>
                                        </div>
                                        <div class='text-secondary2'>
                                            <b><span class='min-w-50px'>Ganhe até</span> <span class='color-default font-larger revenueCt'></span></b>
                                        </div>
                                    </h3>
                                </div>
                                <div class='d-flex align-items-center mb-5'>
                                    <div class='col-4 text-end me-5'>
                                        <strong class=''>Escolha o preço da cota:</strong> 
                                    </div>
                                    <div class='col-6 position-relative'>
                                        <div class='col-12 position-relative'>
                                            <select name='price' class='form-control slPrices'>
                                                @foreach(['7.5', '15', '25', '35', '45', '75', '100', '150', '300', '600', '800', '1000'] as $index => $value)
                                                    <option value='{{ $value }}' {{ $value == 7.5 ? 'selected="selected"' : '' }}>R${{ str_replace('.', ',', $value) }}</option>
                                                @endforeach
                                            </select>
                                            <i class='fa fa-question-circle position-absolute top-0 start-100 translate-middle tooltips' data-toggle="tooltip" data-placement="top" data-html="true" title="Ao escolher valores maiores a quantidade total de cotas será menor"></i>
                                        </div>
                                        <!-- <div class='d-inline'>
                                            @foreach(['7.5', '15', '25', '35', '45'] as $index => $value)
                                                <span class="label label-square {{ $index == 2 ? 'label-dark' : 'label-success' }}">R${{ str_replace('.', ',', $value) }}</span>
                                            @endforeach
                                        </div> -->
                                    </div>
                                </div>
                                <div class='d-flex align-items-center mb-5'>
                                    <div class='col-4 text-end me-5'>
                                        <strong>Ficar com cotas:</strong>
                                    </div>    
                                    <div class='col-6'>
                                        <div class='col-12 position-relative'>
                                            <select name='keepCotas' class='form-control slKeepCotas'>
                                                <option value='0'>0</option>
                                            </select>
                                            <i class='fa fa-question-circle position-absolute top-0 start-100 translate-middle tooltips' data-toggle="tooltip" data-placement="top" data-html="true" title="Ao escolher nenhuma cota você disponibilizará <b>todas</b> para venda e portanto não será premiado pelas loteria (apenas pela venda das cotas)"></i>
                                        </div>
                                    </div>    
                                </div>
                                <div class='d-flex align-items-center mb-5'>
                                    <div class='col-4 text-end me-5'>
                                        <strong>Total de cotas:</strong> 
                                    </div>
                                    <div class='col-6'>
                                        <b class='cotasCt'>0</b><br/>
                                    </div>
                                </div>
                                <div class='d-flex align-items-center mb-5'>
                                    <div class='col-4 text-end me-5'>
                                        <strong class='position-relative'>
                                            Receita estimada:
                                            <i class='fa fa-question-circle font-smaller position-absolute start-100 translate-middle tooltips' data-toggle="tooltip" data-placement="right" data-html="true" title="<b>A receita estimada é o valor que você vai ganhar ao vender todas as cotas</b>."></i>
                                        </strong>
                                    </div>    
                                    <div class='col-3'>
                                        <div class='messageProfit font-larger'>
                                            <b class='color-default revenueCt'></b> 
                                            <br />
                                            <small class='position-relative'>
                                                <!-- <b>Lucro de: <span class='profitCt color-default'></span></b> -->
                                            </small>
                                        </div>
                                    </div>    
                                </div>
                            </div>
                            @if (auth()->guard('web')->check())
                                <div class='d-flex align-items-center mt-4 mb-5'>
                                    <div class='col-4 text-end me-5'>
                                        <strong>Seus créditos:</strong>
                                    </div>    
                                    <div class='col-6'>
                                        <b class='font-larger'>{{ auth()->guard('web')->user()->getFormattedCredits() }}</b>
                                    </div>    
                                </div>
                            @endif
                        </div>

                        <div class='mt-5 listBets'>
                            <h3 class='ps-0'>Apostas 
                                <label class='qtGames'>(0)</label>
                            </h3>
                            <div class='lblHolder mb-4'>
                                <b class='text-primary'>SEU BOLÃO TEM <i class='label label-inline label-primary font-larger px-2 chancesTg'><b></b></i> DE GANHAR!</b>
                            </div>
                            <div class="alert d-none">
                                {{ session()->get('message') }}
                            </div>

                            <div class='games-list border border-secondary border-dashed p-4' data-url='{{ route("adm.boloes.removeGame") }}' data-hasdelete='0' data-chances='{{ $lotery->getChancesJson() }}'>
                                <div class='gamesCt max-h-200px overflow-auto'>
                                </div>
                                <div class='gamesListFooter text-end mt-2 me-4'>
                                    <div class='text-start'>
                                        <div class='alert alert-light ms-0'><i class='fas fa-info-circle me-2 text-primary'></i> Nenhuma aposta adicionada. Escolha seus números da sorte e crie um conjunto de apostas para o seu bolão!</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class='col-md-12 p-4 mt-3 text-end'>
                            <button type="submit" class="btn-finalize btn btn-success ml-2" >
                                <i class="fas fa-check fa-lg"></i> Finalizar
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection