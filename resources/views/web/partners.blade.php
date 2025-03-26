@extends('layouts.web.web')

@section('titlePage', 'Parceiros')
@section('descriptionPage', 'Seja um parceiro e aproveite os beneficios!')

@section('content')

<!--begin::Entry-->
<div class="">
    <!--begin::Container-->
    <div class="">

        <div class=''>
            <section class="py-20 bg-white" id="introduction">
                <div class="container">
                    <div class="text-center mb-5">
                        <h1 class="display-5 text-center mb-3"><b>Seja um parceiro Lotos Online e ganhe 40% de desconto</b></h1>
                        <p class="lead">Ganhe descontos exclusivos para te ajudar a render ainda mais</p>
                    </div>

                    <div class='calculatorProfits col-12 m-auto shadow p-2 px-4 rounded mt-8'>
                        <h2 class="ps-0 text-center display-4"><b>Calculadora de Lucro</b></h2>
                        <div class="d-flex align-items-center mb-5">
                            <div class='col-3 text-end me-5'>
                                <strong>Loteria:</strong>
                            </div>    
                            <div class='col-8'>
                                <select class="form-control slLotery">
                                    @foreach($loteries as $index => $loteries[0])
                                        <option value="{{ $loteries[0]->id }}" {{ $index == 0 ? "selected='selected'" : '' }}>{{ $loteries[0]->name }}</option>
                                    @endforeach
                                </select>
                            </div>    
                        </div><!-- /d-flex -->
                        <div class="d-flex align-items-center mb-5">
                            <div class='col-3 text-end me-5'>
                                <strong>Adicione jogos:</strong>
                            </div>    
                            <div class='col-8'>
                                <div class="d-flex d-flex-responsive justify-content-between">
                                    <div class="mb-1 col">
                                        <div class="input-group bootstrap-touchspin bootstrap-touchspin-injected">
                                            <input type="text" class="form-control inputNumberGames" value="1">
                                        </div>
                                    </div>
                                    <select class="mx-2 form-control col select slGames" data-costs='{{ json_encode($costs) }}'>
                                        
                                    </select>
                                    <div class="mt-1 col"><div class='btn btn-info btnAddGame rounded w-100 text-white'><b><i class="fas fa-plus"></i>Adicionar</b></div></div>
                                </div>
                            </div>    
                        </div><!-- /d-flex -->
                        <div class="d-flex align-items-center mb-5">
                            <div class='col-3 text-end me-5'>
                                <strong>Bolão simulado:</strong>
                            </div>    
                            <div class='col-8 h-150px overflow-scroll border rounded'>
                                <ul class="list-group bolaoGamesList"></ul>
                            </div>    
                        </div><!-- /d-flex -->
                        <div class="d-flex align-items-center mb-5">
                            <div class='col-3 text-end me-5'>
                                <strong>Chances:</strong>
                            </div>    
                            <div class='col-8'>
                                <h2 class="totalChances bg-white text-primary p-2"></h2>
                            </div>    
                        </div><!-- /d-flex -->
                        <div class="d-flex align-items-center mb-5">
                            <div class='col-3 text-end me-5'>
                                <strong>Nº de Bolões Criados:</strong>
                            </div>    
                            <div class='col-2'>
                                <input type="number" class='form-control nBoloesCreated' value="1" /> 
                            </div>    
                        </div><!-- /d-flex -->
                        <div class="d-flex align-items-center mb-5">
                            <div class='col-3 text-end me-5'>
                                <strong>Custo do bolão:</strong>
                            </div>    
                            <div class='col-8'>
                                <div class=""><b class="totalCost"></b></div>
                                <small class="text-gray-600"><i class='fas fa-asterisk text-black me-1 font-smaller'></i><span class="font-larger"><b>40%</b></span> de desconto de parceiro aplicado</small>
                            </div>    
                        </div><!-- /d-flex -->
                        <div class="d-flex align-items-center mb-5">
                            <div class='col-3 text-end me-5'>
                                <strong>Você ganha:</strong>
                            </div>    
                            <div class='col-8'>
                                <div class="totalProfit display-4 color-default"><b></b></div>
                                <small class="text-gray-600"><b><i class='fas fa-asterisk text-black me-1 font-smaller'></i>Baseado na venda total das cotas (já incluso tarifa da plataforma)</b></small>
                            </div>    
                        </div><!-- /d-flex -->
                    </div>
                </div>
            </section>

            <section class="py-10 bg-info text-white" id="howItWorks">
                <div class="container container-bolao">
                    <div class="text-center mb-5">
                        <h2 class="display-5 mb-1"><b>Como ganhar dinheiro vendendo online seus bolões da loteria</b></h2>
                    </div>

                    <div class="row g-4 justify-content-center">
                        <!-- Passo 1 -->
                        <div class="col-md-3">
                            <div class="step-card text-center p-4 position-relative">
                                <div class="step-number border border-white text-white rounded-circle d-inline-flex align-items-center justify-content-center">1</div>
                                <h3 class="h5 mt-4"><b><i class="fas fa-list-ol me-2 text-white"></i>Crie seus bolões</b></h3>
                                <b>Monte seus jogos e crie o seu bolão da loteria</b>
                            </div>
                        </div>

                        <!-- Passo 2 -->
                        <div class="col-md-3">
                            <div class="step-card text-center p-4 position-relative">
                                <div class="step-number border border-white text-white rounded-circle d-inline-flex align-items-center justify-content-center">2</div>
                                <h3 class="h5 mt-4"><b><i class="fas fa-share-alt me-2 text-white"></i>Divulgue e venda cotas</b></h3>
                                <b>Compartilhe seu bolão e promova as vendas das cotas</b>
                            </div>
                        </div>

                        <!-- Passo 3 -->
                        <div class="col-md-3">
                            <div class="step-card text-center p-4">
                                <div class="step-number border border-white text-white rounded-circle d-inline-flex align-items-center justify-content-center">3</div>
                                <h3 class="h5 mt-4"><b><i class="fas fa-money-bill me-2 text-white"></i>Receba sua receita</b></h3>
                                <b>Concorra a prêmios da loteria e ainda receba a receita da venda de suas cotas</b>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <section class="py-10 bg-light" id="advantages">
                <div class="container">
                    <!-- Título da Seção -->
                    <div class="text-center mb-5">
                        <h2 class="display-5"><b>Por que ser um parceiro?</b></h2>
                        <p class="lead">Conheça as vantagens e recursos da plataforma projetadas para você vender de forma segura e eficiente</p>
                    </div>

                    <!-- Lista de Vantagens -->
                    <div class="row g-4">
                        <div class="col-md-6 col-lg-4">
                            <div class="card h-100 shadow-sm border-0">
                                <div class="card-body text-center p-4">
                                    <i class="fas fa-bed fa-3x text-secondary mb-3"></i> <!-- Ícone -->
                                    <h5 class="card-title"><b>Renda Passiva</b></h5>
                                    <p class="card-text">Ganhe enquanto você dorme.</p>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 col-lg-4">
                            <div class="card h-100 shadow-sm border-0">
                                <div class="card-body text-center p-4">
                                    <i class="fas fa-percent fa-3x text-danger mb-3"></i> <!-- Ícone -->
                                    <h5 class="card-title"><b>Desconto Exclusivo</b></h5>
                                    <p class="card-text"><b>Ganhe 40% de desconto</b> em suas apostas (vigente por 3 meses)</p>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 col-lg-4">
                            <div class="card h-100 shadow-sm border-0">
                                <div class="card-body text-center p-4">
                                    <i class="fas fa-dollar-sign fa-3x text-warning mb-3"></i>
                                    <i class="fas fa-dollar-sign fa-3x text-warning mb-3"></i>
                                    <h5 class="card-title"><b>Ganhe duas vezes</b></h5>
                                    <p class="card-text">Você ganha na <b>venda de suas cotas</b> e <b>ao ser premiado!</b></p>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 col-lg-4">
                            <div class="card h-100 shadow-sm border-0">
                                <div class="card-body text-center p-4">
                                    <i class="fas fa-feather fa-3x text-primary mb-3"></i> <!-- Ícone -->
                                    <h5 class="card-title"><b>Compra ágil</b></h5>
                                    <p class="card-text">O checkout de pagamento é otimizado para realizar compras de forma rapida e segura</p>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 col-lg-4">
                            <div class="card h-100 shadow-sm border-0">
                                <div class="card-body text-center p-4">
                                    <i class="fas fa-money-bill-wave fa-3x color-default mb-3"></i> <!-- Ícone -->
                                    <h5 class="card-title"><b>Lucro garantido</b></h5>
                                    <p class="card-text">Ganhe até <b>45% de lucro</b> com seus bolões! Ao vender todas as cotas você sempre cobre os custos</p>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 col-lg-4">
                            <div class="card h-100 shadow-sm border-0">
                                <div class="card-body text-center p-4">
                                    <i class="fas fa-robot fa-3x text-info2 mb-3"></i> <!-- Ícone -->
                                    <h5 class="card-title"><b>Ferramentas automatizadas</b></h5>
                                    <p class="card-text">A conferência dos Bolões é feita automaticamente pela plataforma</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <section class="py-10 bg-white" id="faq">
                <div class="container">
                    <div class="text-center mb-5">
                        <h2 class="display-5 mb-3"><b>FAQ</b></h2>
                        <p class="lead">Consulte nossas perguntas frequentes</p>
                    </div>

                    <div class="row bg-secondary justify-content-center align-items-center"></div>
                        <div class='tab-content'>
                            <div class="accordion accordion-svg-toggle" id="faq">
                                <div class="card">
                                    <div class="card-header" id="faqHeading1">
                                        <a class="card-title text-dark d-flex collapsed" data-toggle="collapse" href="#faq1" aria-expanded="false" aria-controls="faq1" role="button">
                                            <span class="svg-icon svg-icon-primary d-block">
                                                <!--begin::Svg Icon | path:assets/media/svg/icons/Navigation/Angle-double-right.svg-->
                                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                        <polygon points="0 0 24 0 24 24 0 24"></polygon>
                                                        <path d="M12.2928955,6.70710318 C11.9023712,6.31657888 11.9023712,5.68341391 12.2928955,5.29288961 C12.6834198,4.90236532 13.3165848,4.90236532 13.7071091,5.29288961 L19.7071091,11.2928896 C20.085688,11.6714686 20.0989336,12.281055 19.7371564,12.675721 L14.2371564,18.675721 C13.863964,19.08284 13.2313966,19.1103429 12.8242777,18.7371505 C12.4171587,18.3639581 12.3896557,17.7313908 12.7628481,17.3242718 L17.6158645,12.0300721 L12.2928955,6.70710318 Z" fill="#000000" fill-rule="nonzero"></path>
                                                        <path d="M3.70710678,15.7071068 C3.31658249,16.0976311 2.68341751,16.0976311 2.29289322,15.7071068 C1.90236893,15.3165825 1.90236893,14.6834175 2.29289322,14.2928932 L8.29289322,8.29289322 C8.67147216,7.91431428 9.28105859,7.90106866 9.67572463,8.26284586 L15.6757246,13.7628459 C16.0828436,14.1360383 16.1103465,14.7686056 15.7371541,15.1757246 C15.3639617,15.5828436 14.7313944,15.6103465 14.3242754,15.2371541 L9.03007575,10.3841378 L3.70710678,15.7071068 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" transform="translate(9.000003, 11.999999) rotate(-270.000000) translate(-9.000003, -11.999999)"></path>
                                                    </g>
                                                </svg>
                                                <!--end::Svg Icon-->
                                            </span>
                                            <div class="card-label text-dark pl-4">O que é um bolão?</div>
                                        </a>
                                    </div>
                                    <div id="faq1" class="collapse" aria-labelledby="faqHeading1" data-parent="#faq" style="">
                                        <div class="card-body text-dark-50 font-size-lg pl-12">
                                            Um bolão consiste em vários cartões de aposta - o que aumenta significativamente as chances do mesmo ser premiado em relação a uma aposta simples. 
                                            Os bolões são divididos em cotas e podem ser vendidos para vários apostadores, diminuindo assim o valor que cada apostador investe para concorrer ao prêmio.
                                            O valor do prêmio final do bolão é proporcionalmente ao número de cotas de cada participante, onde quem tem mais cotas recebe uma parte maior do prêmio.
                                            O criador do bolão receberá a receita da venda das cotas do bolão ! 
                                        </div>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-header" id="faqHeading2">
                                        <a class="card-title text-dark d-flex collapsed" data-toggle="collapse" href="#faq2" aria-expanded="false" aria-controls="faq3" role="button">
                                            <span class="svg-icon svg-icon-primary">
                                                <!--begin::Svg Icon | path:assets/media/svg/icons/Navigation/Angle-double-right.svg-->
                                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                        <polygon points="0 0 24 0 24 24 0 24"></polygon>
                                                        <path d="M12.2928955,6.70710318 C11.9023712,6.31657888 11.9023712,5.68341391 12.2928955,5.29288961 C12.6834198,4.90236532 13.3165848,4.90236532 13.7071091,5.29288961 L19.7071091,11.2928896 C20.085688,11.6714686 20.0989336,12.281055 19.7371564,12.675721 L14.2371564,18.675721 C13.863964,19.08284 13.2313966,19.1103429 12.8242777,18.7371505 C12.4171587,18.3639581 12.3896557,17.7313908 12.7628481,17.3242718 L17.6158645,12.0300721 L12.2928955,6.70710318 Z" fill="#000000" fill-rule="nonzero"></path>
                                                        <path d="M3.70710678,15.7071068 C3.31658249,16.0976311 2.68341751,16.0976311 2.29289322,15.7071068 C1.90236893,15.3165825 1.90236893,14.6834175 2.29289322,14.2928932 L8.29289322,8.29289322 C8.67147216,7.91431428 9.28105859,7.90106866 9.67572463,8.26284586 L15.6757246,13.7628459 C16.0828436,14.1360383 16.1103465,14.7686056 15.7371541,15.1757246 C15.3639617,15.5828436 14.7313944,15.6103465 14.3242754,15.2371541 L9.03007575,10.3841378 L3.70710678,15.7071068 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" transform="translate(9.000003, 11.999999) rotate(-270.000000) translate(-9.000003, -11.999999)"></path>
                                                    </g>
                                                </svg>
                                                <!--end::Svg Icon-->
                                            </span>
                                            <div class="card-label text-dark pl-4">Posso criar Bolões de quais loterias?</div>
                                        </a>
                                    </div>
                                    <div id="faq2" class="collapse" aria-labelledby="faqHeading2" data-parent="#faq" style="">
                                        <div class="card-body text-dark-50 font-size-lg pl-12">
                                            A {{ env('APP_NAME') }} oferece suporte para criação de bolão das seguintes loterias: <b>Mega sena, Dupla sena, Lotofacil e Quina</b>
                                        </div>
                                    </div>
                                </div>
                                <!--end::Item-->
                                <!--begin::Item-->
                                <div class="card">
                                    <div class="card-header" id="faqHeading3">
                                        <a class="card-title text-dark d-flex collapsed" data-toggle="collapse" href="#faq3" aria-expanded="false" aria-controls="faq3" role="button">
                                            <span class="svg-icon svg-icon-primary">
                                                <!--begin::Svg Icon | path:assets/media/svg/icons/Navigation/Angle-double-right.svg-->
                                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                        <polygon points="0 0 24 0 24 24 0 24"></polygon>
                                                        <path d="M12.2928955,6.70710318 C11.9023712,6.31657888 11.9023712,5.68341391 12.2928955,5.29288961 C12.6834198,4.90236532 13.3165848,4.90236532 13.7071091,5.29288961 L19.7071091,11.2928896 C20.085688,11.6714686 20.0989336,12.281055 19.7371564,12.675721 L14.2371564,18.675721 C13.863964,19.08284 13.2313966,19.1103429 12.8242777,18.7371505 C12.4171587,18.3639581 12.3896557,17.7313908 12.7628481,17.3242718 L17.6158645,12.0300721 L12.2928955,6.70710318 Z" fill="#000000" fill-rule="nonzero"></path>
                                                        <path d="M3.70710678,15.7071068 C3.31658249,16.0976311 2.68341751,16.0976311 2.29289322,15.7071068 C1.90236893,15.3165825 1.90236893,14.6834175 2.29289322,14.2928932 L8.29289322,8.29289322 C8.67147216,7.91431428 9.28105859,7.90106866 9.67572463,8.26284586 L15.6757246,13.7628459 C16.0828436,14.1360383 16.1103465,14.7686056 15.7371541,15.1757246 C15.3639617,15.5828436 14.7313944,15.6103465 14.3242754,15.2371541 L9.03007575,10.3841378 L3.70710678,15.7071068 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" transform="translate(9.000003, 11.999999) rotate(-270.000000) translate(-9.000003, -11.999999)"></path>
                                                    </g>
                                                </svg>
                                                <!--end::Svg Icon-->
                                            </span>
                                            <div class="card-label text-dark pl-4">Após criar um Bolão no site, devo fazer os jogos na loteria?</div>
                                        </a>
                                    </div>
                                    <div id="faq3" class="collapse" aria-labelledby="faqHeading3" data-parent="#faq" style="">
                                        <div class="card-body text-dark-50 font-size-lg pl-12">
                                            Não, para a sua comodidade a plataforma registra e media os jogos na loteria da caixa federal por você.
                                        </div>
                                    </div>
                                </div>
                                <!--end::Item-->
                                <!--begin::Item-->
                                <div class="card">
                                    <div class="card-header" id="faqHeading4">
                                        <a class="card-title text-dark d-flex collapsed" data-toggle="collapse" href="#faq4" aria-expanded="false" aria-controls="faq3" role="button">
                                            <span class="svg-icon svg-icon-primary">
                                                <!--begin::Svg Icon | path:assets/media/svg/icons/Navigation/Angle-double-right.svg-->
                                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                        <polygon points="0 0 24 0 24 24 0 24"></polygon>
                                                        <path d="M12.2928955,6.70710318 C11.9023712,6.31657888 11.9023712,5.68341391 12.2928955,5.29288961 C12.6834198,4.90236532 13.3165848,4.90236532 13.7071091,5.29288961 L19.7071091,11.2928896 C20.085688,11.6714686 20.0989336,12.281055 19.7371564,12.675721 L14.2371564,18.675721 C13.863964,19.08284 13.2313966,19.1103429 12.8242777,18.7371505 C12.4171587,18.3639581 12.3896557,17.7313908 12.7628481,17.3242718 L17.6158645,12.0300721 L12.2928955,6.70710318 Z" fill="#000000" fill-rule="nonzero"></path>
                                                        <path d="M3.70710678,15.7071068 C3.31658249,16.0976311 2.68341751,16.0976311 2.29289322,15.7071068 C1.90236893,15.3165825 1.90236893,14.6834175 2.29289322,14.2928932 L8.29289322,8.29289322 C8.67147216,7.91431428 9.28105859,7.90106866 9.67572463,8.26284586 L15.6757246,13.7628459 C16.0828436,14.1360383 16.1103465,14.7686056 15.7371541,15.1757246 C15.3639617,15.5828436 14.7313944,15.6103465 14.3242754,15.2371541 L9.03007575,10.3841378 L3.70710678,15.7071068 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" transform="translate(9.000003, 11.999999) rotate(-270.000000) translate(-9.000003, -11.999999)"></path>
                                                    </g>
                                                </svg>
                                                <!--end::Svg Icon-->
                                            </span>
                                            <div class="card-label text-dark pl-4">Posso escolher o preço e quantidade de cotas do meu Bolão?</div>
                                        </a>
                                    </div>
                                    <div id="faq4" class="collapse" aria-labelledby="faqHeading4" data-parent="#faq" style="">
                                        <div class="card-body text-dark-50 font-size-lg pl-12">
                                            Oferecemos opções pré-definidas para o valor das cotas e a quantidade de bolões é calculada automaticamente com base no valor total do seus jogos, visando simplificar a sua experiência e garantir que todos os bolões sejam financeiramente viáveis.
                                        </div>
                                    </div>
                                </div>
                                <!--end::Item-->
                                <!--begin::Item-->
                                <div class="card">
                                    <div class="card-header" id="faqHeading5">
                                        <a class="card-title text-dark d-flex collapsed" data-toggle="collapse" href="#faq5" aria-expanded="false" aria-controls="faq4" role="button">
                                            <span class="svg-icon svg-icon-primary">
                                                <!--begin::Svg Icon | path:assets/media/svg/icons/Navigation/Angle-double-right.svg-->
                                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                        <polygon points="0 0 24 0 24 24 0 24"></polygon>
                                                        <path d="M12.2928955,6.70710318 C11.9023712,6.31657888 11.9023712,5.68341391 12.2928955,5.29288961 C12.6834198,4.90236532 13.3165848,4.90236532 13.7071091,5.29288961 L19.7071091,11.2928896 C20.085688,11.6714686 20.0989336,12.281055 19.7371564,12.675721 L14.2371564,18.675721 C13.863964,19.08284 13.2313966,19.1103429 12.8242777,18.7371505 C12.4171587,18.3639581 12.3896557,17.7313908 12.7628481,17.3242718 L17.6158645,12.0300721 L12.2928955,6.70710318 Z" fill="#000000" fill-rule="nonzero"></path>
                                                        <path d="M3.70710678,15.7071068 C3.31658249,16.0976311 2.68341751,16.0976311 2.29289322,15.7071068 C1.90236893,15.3165825 1.90236893,14.6834175 2.29289322,14.2928932 L8.29289322,8.29289322 C8.67147216,7.91431428 9.28105859,7.90106866 9.67572463,8.26284586 L15.6757246,13.7628459 C16.0828436,14.1360383 16.1103465,14.7686056 15.7371541,15.1757246 C15.3639617,15.5828436 14.7313944,15.6103465 14.3242754,15.2371541 L9.03007575,10.3841378 L3.70710678,15.7071068 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" transform="translate(9.000003, 11.999999) rotate(-270.000000) translate(-9.000003, -11.999999)"></path>
                                                    </g>
                                                </svg>
                                                <!--end::Svg Icon-->
                                            </span>
                                            <div class="card-label text-dark pl-4">Como os compradores recebem o prêmio?</div>
                                        </a>
                                    </div>
                                    <div id="faq5" class="collapse" aria-labelledby="faqHeading5" data-parent="#faq" style="">
                                        <div class="card-body text-dark-50 font-size-lg pl-12">
                                            Após a verificação dos jogos serem feitas, o cliente receberá uma notificação por email. O rateio do prêmio é transferido em créditos na conta do comprador - que pode solicitar o saque quando quiser.
                                        </div>
                                    </div>
                                </div>
                                <!--begin::Item-->
                                <div class="card">
                                    <div class="card-header" id="faqHeading7">
                                        <a class="card-title text-dark d-flex collapsed" data-toggle="collapse" href="#faq7" aria-expanded="false" aria-controls="faq4" role="button">
                                            <span class="svg-icon svg-icon-primary">
                                                <!--begin::Svg Icon | path:assets/media/svg/icons/Navigation/Angle-double-right.svg-->
                                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                        <polygon points="0 0 24 0 24 24 0 24"></polygon>
                                                        <path d="M12.2928955,6.70710318 C11.9023712,6.31657888 11.9023712,5.68341391 12.2928955,5.29288961 C12.6834198,4.90236532 13.3165848,4.90236532 13.7071091,5.29288961 L19.7071091,11.2928896 C20.085688,11.6714686 20.0989336,12.281055 19.7371564,12.675721 L14.2371564,18.675721 C13.863964,19.08284 13.2313966,19.1103429 12.8242777,18.7371505 C12.4171587,18.3639581 12.3896557,17.7313908 12.7628481,17.3242718 L17.6158645,12.0300721 L12.2928955,6.70710318 Z" fill="#000000" fill-rule="nonzero"></path>
                                                        <path d="M3.70710678,15.7071068 C3.31658249,16.0976311 2.68341751,16.0976311 2.29289322,15.7071068 C1.90236893,15.3165825 1.90236893,14.6834175 2.29289322,14.2928932 L8.29289322,8.29289322 C8.67147216,7.91431428 9.28105859,7.90106866 9.67572463,8.26284586 L15.6757246,13.7628459 C16.0828436,14.1360383 16.1103465,14.7686056 15.7371541,15.1757246 C15.3639617,15.5828436 14.7313944,15.6103465 14.3242754,15.2371541 L9.03007575,10.3841378 L3.70710678,15.7071068 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" transform="translate(9.000003, 11.999999) rotate(-270.000000) translate(-9.000003, -11.999999)"></path>
                                                    </g>
                                                </svg>
                                                <!--end::Svg Icon-->
                                            </span>
                                            <div class="card-label text-dark pl-4">Quero comprar cotas de bolões, como faço?</div>
                                        </a>
                                    </div>
                                    <div id="faq7" class="collapse" aria-labelledby="faqHeading7" data-parent="#faq" style="">
                                        <div class="card-body text-dark-50 font-size-lg pl-12">
                                            Acesse a página de <a href='{{ route('web.boloes.listing') }}'>Ver Bolões</a>, escolha o bolão desejado, adicione no carrinho e finalize e a compra.
                                        </div>
                                    </div>
                                </div>
                                <!--begin::Item-->
                                <div class="card border-top-0">
                                    <!--begin::Header-->
                                    <div class="card-header" id="faqHeading8">
                                        <a class="card-title text-dark d-flex collapsed" data-toggle="collapse" href="#faq8" aria-expanded="false" aria-controls="faq5" role="button">
                                            <span class="svg-icon svg-icon-primary">
                                                <!--begin::Svg Icon | path:assets/media/svg/icons/Navigation/Angle-double-right.svg-->
                                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                        <polygon points="0 0 24 0 24 24 0 24"></polygon>
                                                        <path d="M12.2928955,6.70710318 C11.9023712,6.31657888 11.9023712,5.68341391 12.2928955,5.29288961 C12.6834198,4.90236532 13.3165848,4.90236532 13.7071091,5.29288961 L19.7071091,11.2928896 C20.085688,11.6714686 20.0989336,12.281055 19.7371564,12.675721 L14.2371564,18.675721 C13.863964,19.08284 13.2313966,19.1103429 12.8242777,18.7371505 C12.4171587,18.3639581 12.3896557,17.7313908 12.7628481,17.3242718 L17.6158645,12.0300721 L12.2928955,6.70710318 Z" fill="#000000" fill-rule="nonzero"></path>
                                                        <path d="M3.70710678,15.7071068 C3.31658249,16.0976311 2.68341751,16.0976311 2.29289322,15.7071068 C1.90236893,15.3165825 1.90236893,14.6834175 2.29289322,14.2928932 L8.29289322,8.29289322 C8.67147216,7.91431428 9.28105859,7.90106866 9.67572463,8.26284586 L15.6757246,13.7628459 C16.0828436,14.1360383 16.1103465,14.7686056 15.7371541,15.1757246 C15.3639617,15.5828436 14.7313944,15.6103465 14.3242754,15.2371541 L9.03007575,10.3841378 L3.70710678,15.7071068 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" transform="translate(9.000003, 11.999999) rotate(-270.000000) translate(-9.000003, -11.999999)"></path>
                                                    </g>
                                                </svg>
                                                <!--end::Svg Icon-->
                                            </span>
                                            <div class="card-label text-dark pl-4">Como solicito o resgate de prêmios?</div>
                                        </a>
                                    </div>
                                    <!--end::Header-->
                                    <!--begin::Body-->
                                    <div id="faq8" class="collapse" aria-labelledby="faqHeading8" data-parent="#faq" style="">
                                        <div class="card-body text-dark-50 font-size-lg pl-12">
                                            Para fazer o resgate basta logar na sua conta do {{ env('APP_NAME') }}, acessar a página de <a href='{{ route("web.customers.rescue") }}'>Resgate de créditos</a>.
                                            Preencha corretamente todas as informações solicitadas e em seguida envie a solicitação de saque. 
                                            Em até 48 horas o valor será depositado no pix informado!
                                        </div>
                                    </div>
                                    <!--end::Body-->
                                </div>
                                <!--end::Item-->
                                <!--begin::Item-->
                                <div class="card border-top-0">
                                    <!--begin::Header-->
                                    <div class="card-header" id="faqHeading9">
                                        <div class="card-title text-dark d-flex collapsed" data-toggle="collapse" data-target="#faq9" aria-expanded="false" aria-controls="faq7" role="button">
                                            <span class="svg-icon svg-icon-primary">
                                                <!--begin::Svg Icon | path:assets/media/svg/icons/Navigation/Angle-double-right.svg-->
                                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                        <polygon points="0 0 24 0 24 24 0 24"></polygon>
                                                        <path d="M12.2928955,6.70710318 C11.9023712,6.31657888 11.9023712,5.68341391 12.2928955,5.29288961 C12.6834198,4.90236532 13.3165848,4.90236532 13.7071091,5.29288961 L19.7071091,11.2928896 C20.085688,11.6714686 20.0989336,12.281055 19.7371564,12.675721 L14.2371564,18.675721 C13.863964,19.08284 13.2313966,19.1103429 12.8242777,18.7371505 C12.4171587,18.3639581 12.3896557,17.7313908 12.7628481,17.3242718 L17.6158645,12.0300721 L12.2928955,6.70710318 Z" fill="#000000" fill-rule="nonzero"></path>
                                                        <path d="M3.70710678,15.7071068 C3.31658249,16.0976311 2.68341751,16.0976311 2.29289322,15.7071068 C1.90236893,15.3165825 1.90236893,14.6834175 2.29289322,14.2928932 L8.29289322,8.29289322 C8.67147216,7.91431428 9.28105859,7.90106866 9.67572463,8.26284586 L15.6757246,13.7628459 C16.0828436,14.1360383 16.1103465,14.7686056 15.7371541,15.1757246 C15.3639617,15.5828436 14.7313944,15.6103465 14.3242754,15.2371541 L9.03007575,10.3841378 L3.70710678,15.7071068 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" transform="translate(9.000003, 11.999999) rotate(-270.000000) translate(-9.000003, -11.999999)"></path>
                                                    </g>
                                                </svg>
                                                <!--end::Svg Icon-->
                                            </span>
                                            <div class="card-label text-dark pl-4">O que acontece com as cotas que não foram vendidas do meu bolão?</div>
                                        </div>
                                    </div>
                                    <!--end::Header-->
                                    <!--begin::Body-->
                                    <div id="faq9" class="collapse" aria-labelledby="faqHeading9" data-parent="#faq" style="">
                                        <div class="card-body text-dark-50 font-size-lg pl-12">
                                            O criador do bolão possui propriedade sobre as cotas, sendo assim ao ser premiado ele irá receber pela quantidade de cotas que possuir.
                                        </div>
                                    </div>
                                    <!--end::Body-->
                                </div>
                            </div><!-- /accordion -->
                        </div><!-- /tab-c -->
                    </div>
                </div>
            </section>

            <section class="py-20" id="contact">
                <div class="container">
                    <div class="text-center mb-5">
                        <h2 class="display-5 mb-3 ps-0"><b>Comece a ganhar hoje!</b></h2>
                        <p class="lead">Afilicie ao nosso programa de parceiros e receba vantagens exclusivas!</p>
                    </div>

                    <div class="row justify-content-center align-items-center">
                        <div class='text-center'>
                            <a class="btn btn-info btn-lg mt-3" data-toggle="modal" data-target="#registerPartnerModal"><b>Quero ser parceiro</b></a>
                            <a class="btn btn-warning btn-lg mt-3" data-toggle="modal" data-target="#requestPlatformModal"><b>Duvidas? Entre em contato</b></a>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div><!--end::Container-->
</div><!--end::Entry-->

<!-- Modal-->
<div class="modal fade" id="registerPartnerModal" data-backdrop="true" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="card card-custom gutter-b example example-compact">
                <div class="card-header">
                    <h3 class="card-title ps-0"><img src="{{ asset('img/icon-lotos-facil.png') }}" class='me-2 max-h-20px' /> Quero ser parceiro</h3>
                    <div class="card-toolbar">
                        <button type="button" class="close ms-6 me-2" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                </div>

                @include('web.includes.alert')

                <!--begin::Form-->
                <form id='RegisterForm' data-url="{{ route('web.customers.store') }}" method="POST" class="form form-ajax" redirect='1'>
                    {{ csrf_field() }}

                    <div class="card-body">

                        <div class="alert d-none mb-5"></div>

                        <input type="hidden" name="partner" value="1">

                        <div class="form-group row p-1">
                            <div class="col-lg-6">
                                <label><strong>Nome Completo*:</strong></label>
                                <input type="text" name="full_name" class="form-control" value="{{ old('full_name') }}" />
                            </div>
                            <div class="col-lg-6">
                                <label><strong>CPF*:</strong></label>
                                <input type="text" name="cpf" class="form-control maskCpf" value="{{ old('cpf') }}" />
                            </div>
                        </div>
                        <div class="form-group row p-1">
                            <div class="col-lg-6">
                                <label><strong>Email*:</strong></label>
                                <input type="email" name="email" class="form-control" value="{{ old('email') }}" />
                            </div>
                            <div class="col-lg-6">
                                <label><strong>Data de nascimento*:</strong></label>
                                <input type="text" name="birthday_date" class="form-control maskBirthday" value="{{ old('birthday_date') }}" />
                            </div>
                        </div>
                        <div class="form-group row p-1">
                            <div class="col-lg-6">
                                <label><strong>Senha*:</strong></label>
                                <input type="password" name="password" class="form-control" />
                            </div>
                            <div class="col-lg-6">
                                <label><strong>Confirmar Senha*:</strong></label>
                                <input type="password" name="password_confirmation" class="form-control" />
                            </div>
                        </div>
                        <div class="form-group row p-1">
                            <div class="col-lg-12">
                                <div class="checkbox-single">
                                    <label class="checkbox">
                                        <input type="checkbox" name="terms" checked="checked" value='1'>Concordo com os <a href='{{ route("web.staticPages.terms") }}' target='_blank'><u><b>termos de uso</b></u></a>
                                        <span></span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row p-5">
                            <button class="btn btn-success mr-2 btn-send"><strong>Criar Conta</strong></button>
                        </div>
                    </div>
                </form>
                <!--end::Form-->
            </div>
        </div>
    </div>
</div>

<!-- Modal-->
<div class="modal fade" id="requestPlatformModal" data-backdrop="true" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="card card-custom gutter-b example example-compact mb-0">
                <div class="card-header">
                    <h3 class="card-title ps-0"><img src="{{ asset('img/icon-lotos-facil.png') }}" class='me-2 max-h-20px' /> Entrar em contato</h3>
                    <div class="card-toolbar">
                        <button type="button" class="close ms-6 me-2" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                </div>

                <!--begin::Form-->
                <form id='contactForm' data-url="{{ route('web.staticPages.postPlatform') }}" method="POST" class="form form-ajax">
                    {{ csrf_field() }}

                    <div class="card-body">

                        <div class="alert d-none mb-5"></div>

                        <div class="form-group row p-1">
                            <div class="col-lg-12">
                                <label><strong>Nome*:</strong></label>
                                <input type="text" name="name" class="form-control" value="{{ old('name') }}" />
                            </div>
                        </div>
                        <div class="form-group row p-1">
                            <div class="col-lg-12">
                                <label><strong>Email*:</strong></label>
                                <input type="email" name="email" class="form-control" value="{{ old('email') }}" />
                            </div>
                        </div>
                        <div class="form-group row p-1">
                            <div class="col-lg-12">
                                <label><strong>Mensagem:</strong></label>
                                <textarea name='message' class='form-control'></textarea>
                            </div>
                        </div>
                        <!-- <div class="form-group row p-1">
                            <div class="col-lg-12">
                                <label><strong>Captcha*:</strong></label>
                                <div class='position-relative'>
                                    {!! RecaptchaV3::field('captcha') !!}
                                </div>
                            </div>
                        </div> -->
                        <div class="form-group p-0 mt-3">
                            <button class="btn btn-success ms-1 btn-send"><strong>Enviar</strong></button>
                        </div>
                    </div>
                </form>
                <!--end::Form-->
            </div>
        </div>
    </div>
</div>

@endsection