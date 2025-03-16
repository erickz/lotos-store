@extends('layouts.web.web')

@section('titlePage', 'Crie seu Próprio Bolão de Loteria aqui na ' . env('APP_NAME') . '!')
@section('descriptionPage', 'Monte seu próprio bolão de loteria e aumente suas chances de vitória. 
Compartilhe e venda seus jogos, maximize as possibilidades e celebre prêmios. Crie seu bolão agora!')

@section('content')

<div class="d-flex flex-column-fluid mt-5" id='bolaoFinalize'>
    <!--begin::Container-->
    <div class="container">
        <div class="col-lg-12">
            <div class="main-box clearfix">                
                <div class="row profile-user-info">
                    @include('web.boloes.wizard.menu_steps')

                    <form method='POST' action='{{ route("web.boloes.finalize", strtolower($lotery->initials)) }}' class='formFinalize'>
                        @csrf
                        <input type='hidden' name='totalToPay' class='inputHdTotalToPay' value='0' />
                        <div class='mt-3'>
                            <div class='mb-5'>
                                <h2>Personalize seu bolão</h2>
                            </div>
                            <div class="alert border mb-4 ps-2 pe-3" role="alert">
                                <div class="alert-icon d-inline">
                                    <i class="fas fa-info-circle fa-fw fa-lg text-primary"></i>
                                </div>
                                <div class="text-primary d-inline">Selecione o concurso, escolha o preço das cotas e a quantidade que deseja manter</div>
                            </div>
                            <div class='col-md-3 m-auto text-center mb-5'>
                                <h3 class='bg-light p-2 rounded'>
                                    <div class='text-secondary2'>
                                        <span class='min-w-50px me-2'>Pague</span> <b class='font-smaller text-secondary costCt'></b>
                                    </div>
                                    <div class='text-secondary2'>
                                        <span class='min-w-50px'>Ganhe até</span> <b class='color-default font-larger revenueCt'></b> 
                                    </div>
                                </h3>
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
                        
                        <div class='col-md-12 p-4 mt-3 text-end'>
                            <button type="submit" class="btn-finalize btn btn-success ml-2" >
                                Prosseguir <i class="fas fa-chevron-right fa-lg ms-2"></i>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection