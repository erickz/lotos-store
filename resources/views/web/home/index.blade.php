@extends('layouts.web.web')

@section('titlePage', env("APP_NAME") . ' | Bolões da Mega Sena, Lotofácil e Mais | Aposte, Venda e Ganhe!')
@section('descriptionPage', 'Crie ou participe de Bolões das loterias com segurança! Maiores ganhos, pagamento rápido e suporte especializado. Comece agora!')

@section('content')

<!--begin::Entry-->
<div class="">
    <!--begin::Container-->
    <div class="">

        <div class=''>
            <section class="py-30 bg-white" id="home">
                <div class="container">
                    <div class="text-center mb-5">
                        <!-- <h1 class="display-5 text-center mb-3"><b>Crie um Bolão e venda suas cotas online 🤑</b></h1> -->
                        <h2 class="display-5 text-center mb-3"><b>Monte seus jogos ou compre cotas online! 🤑</b></h2>
                        <p class="lead">Crie bolões lucrativos ou compre cotas e concorra a prêmios das loterias, tudo com segurança e praticidade!</p>
                    </div>

                    <div class="row g-4 justify-content-center">
                        <div class='text-center'>
                            <button class='btn btn-lg bg-info text-white text-center' data-toggle="modal" data-target="#registerModal">
                                <b>Começar agora <i class="fas fa-rocket ms-2 text-white"></i></b>
                            </button>
                        </div>
                    </div>
                </div>
            </section>

            <section class="py-10 bg-info2 text-white" id="howItWorks">
                <div class="d-flex justify-content-center text-center mb-4">
                    <div class="d-flex justify-content-center text-center tgHolder">
                        <label class="col-form-label tgCreateBolao rounded rounded-right-0 bg-info2 border border-end-0 pt-3 px-2 text-white" style="border-color: #FFF !Important;"><b>Quero criar um Bolão</b></label>
                        <div class="switchHolder border-top border-bottom bg-diagonal bg-diagonal-info bg-diagonal-r-primary overflow">
                            <span class="switch switch-info mt-1 position-relative">
                                <label>
                                    <input type="checkbox" name="select">
                                    <span class="border"></span>
                                </label>
                            </span>
                        </div>
                        <label class="col-form-label tgBuyCotas rounded rounded-left-0 bg-primary border border-start-0 pt-3 px-2 text-white"><b>Quero comprar cotas</b></label>
                    </div>
                </div>

                <div class="container container-bolao">
                    <div class="text-center mb-5">
                        <h2 class="display-5 mb-1"><b>Como criar um Bolão e vender as cotas online</b></h2>
                        <p class="lead">Ganhe dinheiro vendendo seus bolões da loteria online!</p>
                    </div>

                    <div class="row g-4 justify-content-center">
                        <!-- Passo 1 -->
                        <div class="col-md-3">
                            <div class="step-card text-center p-4 position-relative">
                                <div class="step-number border border-white text-white rounded-circle d-inline-flex align-items-center justify-content-center">1</div>
                                <h3 class="h5 mt-4"><b><i class="fas fa-list-ol me-2 text-white"></i>Crie</b></h3>
                                <b>Monte seus jogos e crie o seu bolão da loteria</b>
                            </div>
                        </div>

                        <!-- Passo 2 -->
                        <div class="col-md-3">
                            <div class="step-card text-center p-4 position-relative">
                                <div class="step-number border border-white text-white rounded-circle d-inline-flex align-items-center justify-content-center">2</div>
                                <h3 class="h5 mt-4"><b><i class="fas fa-share-alt me-2 text-white"></i>Divulgue</b></h3>
                                <b>Compartilhe seu bolão e venda as cotas</b>
                            </div>
                        </div>

                        <!-- Passo 3 -->
                        <div class="col-md-3">
                            <div class="step-card text-center p-4">
                                <div class="step-number border border-white text-white rounded-circle d-inline-flex align-items-center justify-content-center">3</div>
                                <h3 class="h5 mt-4"><b><i class="fas fa-money-bill me-2 text-white"></i>Receba</b></h3>
                                <b>Receba a receita de suas vendas</b>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="container container-cotas" style="display: none;">
                    <div class="text-center mb-5">
                        <h2 class="display-5 mb-1"><b>Como comprar cotas online e concorrer a loteria</b></h2>
                        <p class="lead">Concorra com muito mais chances a prêmios milionários</p>
                    </div>

                    <div class="row g-4 justify-content-center">
                        <!-- Passo 1 -->
                        <div class="col-md-3">
                            <div class="step-card text-center p-4 position-relative">
                                <div class="step-number border border-white text-white rounded-circle d-inline-flex align-items-center justify-content-center">1</div>
                                <h3 class="h5 mt-4"><b><i class="fas fa-shopping-cart me-2 text-white"></i>Selecione</b></h3>
                                <b><a href="{{ route('web.boloes.listing') }}" class="text-white"><u>Veja os bolões disponíveis</u></a> e escolha quantas cotas quiser</b>
                            </div>
                        </div>

                        <!-- Passo 2 -->
                        <div class="col-md-3">
                            <div class="step-card text-center p-4 position-relative">
                                <div class="step-number border border-white text-white rounded-circle d-inline-flex align-items-center justify-content-center">2</div>
                                <h3 class="h5 mt-4"><b><i class="fas fa-shopping-bag me-2 text-white"></i>Pague</b></h3>
                                <b>Pague as cotas do seu carrinho para efetuar a compra</b>
                            </div>
                        </div>

                        <!-- Passo 3 -->
                        <div class="col-md-3">
                            <div class="step-card text-center p-4">
                                <div class="step-number border border-white text-white rounded-circle d-inline-flex align-items-center justify-content-center">3</div>
                                <h3 class="h5 mt-4"><b><i class="fas fa-trophy me-2 text-white"></i>Concorra</b></h3>
                                <b>Concorra com muito mais chances aos prêmios milionários da Loteria</b>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            @if (count($boloes) > 0)
                <div class='boloesListing mt-5 container'>
                    <h2 class='ps-0'><b class='d-flex'><span>Top Bolões da semana</span></b></h2>
                    @include('web.boloes.listing_boloes', ['boloes' => $boloes])
                </div>
            @endif

            <section class="py-20 bg-light" id="advantages">
                <div class="container">
                    <!-- Título da Seção -->
                    <div class="text-center mb-5">
                        <h2 class="display-5"><b>Vantagens da Plataforma</b></h2>
                        <p class="lead">Tudo o que você precisa para gerenciar seus bolões de forma eficiente.</p>
                    </div>

                    <!-- Lista de Vantagens -->
                    <div class="row g-4">
                        <!-- Vantagem 1 -->
                        <div class="col-md-6 col-lg-4">
                            <div class="card h-100 shadow-sm border-0">
                                <div class="card-body text-center p-4">
                                    <i class="fas fa-trophy fa-3x text-primary mb-3"></i> <!-- Ícone -->
                                    <h5 class="card-title"><b>Gerenciamento de Bolões</b></h5>
                                    <p class="card-text text-muted">Organize e gerencie seus bolões de forma simples e eficaz.</p>
                                </div>
                            </div>
                        </div>

                        <!-- Vantagem 2 -->
                        <!-- <div class="col-md-6 col-lg-4">
                            <div class="card h-100 shadow-sm border-0">
                                <div class="card-body text-center p-4">
                                    <i class="fas fa-wallet fa-3x text-success mb-3"></i>
                                    <h5 class="card-title"><b>Sistema de Créditos</b></h5>
                                    <p class="card-text text-muted">Utilize créditos para facilitar suas transações.</p>
                                </div>
                            </div>
                        </div> -->

                        <!-- Vantagem 3 -->
                        <div class="col-md-6 col-lg-4">
                            <div class="card h-100 shadow-sm border-0">
                                <div class="card-body text-center p-4">
                                    <i class="fas fa-credit-card fa-3x text-info mb-3"></i> <!-- Ícone -->
                                    <h5 class="card-title"><b>Aceita Pix e Cartão de Crédito</b></h5>
                                    <p class="card-text text-muted">Diversas opções de pagamento para sua comodidade.</p>
                                </div>
                            </div>
                        </div>

                        <!-- Vantagem 4 -->
                        <div class="col-md-6 col-lg-4">
                            <div class="card h-100 shadow-sm border-0">
                                <div class="card-body text-center p-4">
                                    <i class="fas fa-chart-line fa-3x text-warning mb-3"></i> <!-- Ícone -->
                                    <h5 class="card-title"><b>Painel Administrativo</b></h5>
                                    <p class="card-text text-muted">Controle total sobre suas operações.</p>
                                </div>
                            </div>
                        </div>

                        <!-- Vantagem 5 -->
                        <div class="col-md-6 col-lg-4">
                            <div class="card h-100 shadow-sm border-0">
                                <div class="card-body text-center p-4">
                                    <i class="fas fa-user-cog fa-3x text-danger mb-3"></i> <!-- Ícone -->
                                    <h5 class="card-title"><b>Painel do Cliente</b></h5>
                                    <p class="card-text text-muted">Interface amigável para seus clientes.</p>
                                </div>
                            </div>
                        </div>

                        <!-- Vantagem 6 -->
                        <div class="col-md-6 col-lg-4">
                            <div class="card h-100 shadow-sm border-0">
                                <div class="card-body text-center p-4">
                                    <i class="fas fa-brain fa-3x text-secondary mb-3"></i> <!-- Ícone -->
                                    <h5 class="card-title"><b>Sistema Inteligente de Geração de Jogos</b></h5>
                                    <p class="card-text text-muted">Gere jogos de forma rápida e inteligente.</p>
                                </div>
                            </div>
                        </div>

                        <!-- Vantagem 7 -->
                        <div class="col-md-6 col-lg-4">
                            <div class="card h-100 shadow-sm border-0">
                                <div class="card-body text-center p-4">
                                    <i class="fas fa-check-circle fa-3x text-primary mb-3"></i> <!-- Ícone -->
                                    <h5 class="card-title"><b>Verificação Automática de Resultados</b></h5>
                                    <p class="card-text text-muted">Resultados verificados automaticamente.</p>
                                </div>
                            </div>
                        </div>

                        <!-- Vantagem 8 -->
                        <!-- <div class="col-md-6 col-lg-4">
                            <div class="card h-100 shadow-sm border-0">
                                <div class="card-body text-center p-4">
                                    <i class="fas fa-share-alt fa-3x text-success mb-3"></i>
                                    <h5 class="card-title"><b>Compartilhamento de Bolões</b></h5>
                                    <p class="card-text text-muted">Compartilhe bolões com facilidade.</p>
                                </div>
                            </div>
                        </div> -->

                        <!-- Vantagem 9 -->
                        <!-- <div class="col-md-6 col-lg-4">
                            <div class="card h-100 shadow-sm border-0">
                                <div class="card-body text-center p-4">
                                    <i class="fas fa-gift fa-3x text-danger mb-3"></i>
                                    <h5 class="card-title"><b>Presentear Cotas</b></h5>
                                    <p class="card-text text-muted">Presenteie cotas de bolões para seus amigos.</p>
                                </div>
                            </div>
                        </div> -->

                        <!-- Vantagem 10 -->
                        <div class="col-md-6 col-lg-4">
                            <div class="card h-100 shadow-sm border-0">
                                <div class="card-body text-center p-4">
                                    <i class="fas fa-bolt fa-3x text-warning mb-3"></i> <!-- Ícone -->
                                    <h5 class="card-title"><b>Criação Rápida</b></h5>
                                    <p class="card-text text-muted">Crie e configure um bolão em minutos!</p>
                                </div>
                            </div>
                        </div>

                        <!-- Vantagem 11 -->
                        <div class="col-md-6 col-lg-4">
                            <div class="card h-100 shadow-sm border-0">
                                <div class="card-body text-center p-4">
                                    <i class="fas fa-user-shield fa-3x text-primary mb-3"></i> <!-- Ícone -->
                                    <h5 class="card-title"><b>Segurança</b></h5>
                                    <p class="card-text text-muted">Transações e dados protegidos.</p>
                                </div>
                            </div>
                        </div>

                        <!-- Vantagem 12 -->
                        <div class="col-md-6 col-lg-4">
                            <div class="card h-100 shadow-sm border-0">
                                <div class="card-body text-center p-4">
                                    <i class="fas fa-chart-pie fa-3x text-success mb-3"></i> <!-- Ícone -->
                                    <h5 class="card-title"><b>Relatórios detalhados</b></h5>
                                    <p class="card-text text-muted">Analise suas vendas em tempo real.</p>
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
                        @include('web.faq_container', ['allFaq' => false])
                    </div>
                </div>
            </section>

            {{-- <section id="plans" class="card-body position-relative p-0 rounded-card-top mt-4">
                <div class="row justify-content-center mx-0 d-none d-lg-flex">
                    <div class="col-11">
                        <div class="row">
                            <!-- begin: Pricing-->
                            <div class="offset-lg-3 col-12 col-lg-3 bg-white p-0">
                                <div class="py-15 px-0 px-lg-5 text-center">
                                    <div class="d-flex flex-center mb-7">
                                        <span class="svg-icon svg-icon-5x svg-icon-primary">
                                            <!--begin::Svg Icon | path:assets/media/svg/icons/Home/Flower3.svg-->
                                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                    <polygon points="0 0 24 0 24 24 0 24"></polygon>
                                                    <path d="M1.4152146,4.84010415 C11.1782334,10.3362599 14.7076452,16.4493804 12.0034499,23.1794656 C5.02500006,22.0396582 1.4955883,15.9265377 1.4152146,4.84010415 Z" fill="#000000" opacity="0.3"></path>
                                                    <path d="M22.5950046,4.84010415 C12.8319858,10.3362599 9.30257403,16.4493804 12.0067693,23.1794656 C18.9852192,22.0396582 22.5146309,15.9265377 22.5950046,4.84010415 Z" fill="#000000" opacity="0.3"></path>
                                                    <path d="M12.0002081,2 C6.29326368,11.6413199 6.29326368,18.7001435 12.0002081,23.1764706 C17.4738192,18.7001435 17.4738192,11.6413199 12.0002081,2 Z" fill="#000000" opacity="0.3"></path>
                                                </g>
                                            </svg>
                                            <!--end::Svg Icon-->
                                        </span>
                                    </div>
                                    <h4 class="font-size-h3 mb-10 text-dark">Básico</h4>
                                    <div class="d-flex flex-column pb-7 text-dark-50">
                                        <span>Lorem ipsum dolor adipiscing</span>
                                        <span>do eiusmod tempors</span>
                                    </div>
                                    <span class="font-size-h1 font-weight-boldest text-dark">
                                    <sup class="font-size-h3 font-weight-normal pl-1"><b>Grátis</b></sup></span>
                                    <!--begin::Mobile Pricing Table-->
                                    <div class="d-lg-none">
                                        <div class="bg-gray-100 py-3">
                                            <span class="font-weight-boldest">Number Of Users</span>
                                            <span>Up to 10k</span>
                                        </div>
                                        <div class="py-3">
                                            <span class="font-weight-boldest">Domains</span>
                                            <span>1</span>
                                        </div>
                                        <div class="bg-gray-100 py-3">
                                            <span class="font-weight-boldest">Projects</span>
                                            <span>5</span>
                                        </div>
                                        <div class="py-3">
                                            <span class="font-weight-boldest">Storage</span>
                                            <span>5GB</span>
                                        </div>
                                        <div class="bg-gray-100 py-3">
                                            <span class="font-weight-boldest">Supporet</span>
                                            <span>No</span>
                                        </div>
                                        <div class="py-3">
                                            <span class="font-weight-boldest">Tutorials</span>
                                            <span>No</span>
                                        </div>
                                        <div class="bg-gray-100 py-3">
                                            <span class="font-weight-boldest">Cancelation</span>
                                            <span>Yes</span>
                                        </div>
                                    </div>
                                    <!--end::Mobile Pricing Table-->
                                    <div class="mt-7">
                                        <button type="button" class="btn btn-primary text-uppercase font-weight-bolder px-15 py-3">Purchase</button>
                                    </div>
                                </div>
                            </div>
                            <!-- end: Pricing-->
                            <!-- begin: Pricing-->
                            <div class="col-12 col-lg-3 bg-white border-x-0 border-x-lg border-y border-y-lg-0 p-0">
                                <div class="py-15 px-0 px-lg-5 text-center">
                                    <div class="d-flex flex-center mb-7">
                                        <span class="svg-icon svg-icon-5x svg-icon-primary">
                                            <!--begin::Svg Icon | path:assets/media/svg/icons/Tools/Compass.svg-->
                                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                    <rect x="0" y="0" width="24" height="24"></rect>
                                                    <path d="M7.07744993,12.3040451 C7.72444571,13.0716094 8.54044565,13.6920474 9.46808594,14.1079953 L5,23 L4.5,18 L7.07744993,12.3040451 Z M14.5865511,14.2597864 C15.5319561,13.9019016 16.375416,13.3366121 17.0614026,12.6194459 L19.5,18 L19,23 L14.5865511,14.2597864 Z M12,3.55271368e-14 C12.8284271,3.53749572e-14 13.5,0.671572875 13.5,1.5 L13.5,4 L10.5,4 L10.5,1.5 C10.5,0.671572875 11.1715729,3.56793164e-14 12,3.55271368e-14 Z" fill="#000000" opacity="0.3"></path>
                                                    <path d="M12,10 C13.1045695,10 14,9.1045695 14,8 C14,6.8954305 13.1045695,6 12,6 C10.8954305,6 10,6.8954305 10,8 C10,9.1045695 10.8954305,10 12,10 Z M12,13 C9.23857625,13 7,10.7614237 7,8 C7,5.23857625 9.23857625,3 12,3 C14.7614237,3 17,5.23857625 17,8 C17,10.7614237 14.7614237,13 12,13 Z" fill="#000000" fill-rule="nonzero"></path>
                                                </g>
                                            </svg>
                                            <!--end::Svg Icon-->
                                        </span>
                                    </div>
                                    <h4 class="font-size-h3 mb-10 text-dark">For Business</h4>
                                    <div class="d-flex flex-column pb-7 text-dark-50">
                                        <span>Lorem ipsum dolor adipiscing</span>
                                        <span>do eiusmod tempors</span>
                                    </div>
                                    <span class="font-size-h1 font-weight-boldest text-dark">169
                                    <sup class="font-size-h3 font-weight-normal pl-1">$</sup></span>
                                    <!--begin::Mobile Pricing Table-->
                                    <div class="d-lg-none">
                                        <div class="bg-gray-100 py-3">
                                            <span class="font-weight-boldest">Number Of Users</span>
                                            <span>Up to 100k</span>
                                        </div>
                                        <div class="py-3">
                                            <span class="font-weight-boldest">Domains</span>
                                            <span>20</span>
                                        </div>
                                        <div class="bg-gray-100 py-3">
                                            <span class="font-weight-boldest">Projects</span>
                                            <span>100</span>
                                        </div>
                                        <div class="py-3">
                                            <span class="font-weight-boldest">Storage</span>
                                            <span>200GB</span>
                                        </div>
                                        <div class="bg-gray-100 py-3">
                                            <span class="font-weight-boldest">Supporet</span>
                                            <span>Yes</span>
                                        </div>
                                        <div class="py-3">
                                            <span class="font-weight-boldest">Tutorials</span>
                                            <span>Yes</span>
                                        </div>
                                        <div class="bg-gray-100 py-3">
                                            <span class="font-weight-boldest">Cancelation</span>
                                            <span>Yes</span>
                                        </div>
                                    </div>
                                    <!--end::Mobile Pricing Table-->
                                    <div class="mt-7">
                                        <button type="button" class="btn btn-primary text-uppercase font-weight-bolder px-15 py-3">Purchase</button>
                                    </div>
                                </div>
                            </div>
                            <!-- end: Pricing-->
                            <!-- begin: Pricing-->
                            <div class="col-12 col-lg-3 bg-white mb-10 mb-lg-0 p-0">
                                <div class="py-15 px-0 px-lg-5 text-center">
                                    <div class="d-flex flex-center mb-7">
                                        <span class="svg-icon svg-icon-5x svg-icon-primary">
                                            <!--begin::Svg Icon | path:assets/media/svg/icons/Shopping/Cart2.svg-->
                                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                    <rect x="0" y="0" width="24" height="24"></rect>
                                                    <path d="M12,4.56204994 L7.76822128,9.6401844 C7.4146572,10.0644613 6.7840925,10.1217854 6.3598156,9.76822128 C5.9355387,9.4146572 5.87821464,8.7840925 6.23177872,8.3598156 L11.2317787,2.3598156 C11.6315738,1.88006147 12.3684262,1.88006147 12.7682213,2.3598156 L17.7682213,8.3598156 C18.1217854,8.7840925 18.0644613,9.4146572 17.6401844,9.76822128 C17.2159075,10.1217854 16.5853428,10.0644613 16.2317787,9.6401844 L12,4.56204994 Z" fill="#000000" fill-rule="nonzero" opacity="0.3"></path>
                                                    <path d="M3.28077641,9 L20.7192236,9 C21.2715083,9 21.7192236,9.44771525 21.7192236,10 C21.7192236,10.0817618 21.7091962,10.163215 21.6893661,10.2425356 L19.5680983,18.7276069 C19.234223,20.0631079 18.0342737,21 16.6576708,21 L7.34232922,21 C5.96572629,21 4.76577697,20.0631079 4.43190172,18.7276069 L2.31063391,10.2425356 C2.17668518,9.70674072 2.50244587,9.16380623 3.03824078,9.0298575 C3.11756139,9.01002735 3.1990146,9 3.28077641,9 Z M12,12 C11.4477153,12 11,12.4477153 11,13 L11,17 C11,17.5522847 11.4477153,18 12,18 C12.5522847,18 13,17.5522847 13,17 L13,13 C13,12.4477153 12.5522847,12 12,12 Z M6.96472382,12.1362967 C6.43125772,12.2792385 6.11467523,12.8275755 6.25761704,13.3610416 L7.29289322,17.2247449 C7.43583503,17.758211 7.98417199,18.0747935 8.51763809,17.9318517 C9.05110419,17.7889098 9.36768668,17.2405729 9.22474487,16.7071068 L8.18946869,12.8434035 C8.04652688,12.3099374 7.49818992,11.9933549 6.96472382,12.1362967 Z M17.0352762,12.1362967 C16.5018101,11.9933549 15.9534731,12.3099374 15.8105313,12.8434035 L14.7752551,16.7071068 C14.6323133,17.2405729 14.9488958,17.7889098 15.4823619,17.9318517 C16.015828,18.0747935 16.564165,17.758211 16.7071068,17.2247449 L17.742383,13.3610416 C17.8853248,12.8275755 17.5687423,12.2792385 17.0352762,12.1362967 Z" fill="#000000"></path>
                                                </g>
                                            </svg>
                                            <!--end::Svg Icon-->
                                        </span>
                                    </div>
                                    <h4 class="font-size-h3 mb-10 text-dark">Enterprise</h4>
                                    <div class="d-flex flex-column pb-7 text-dark-50">
                                        <span>Lorem ipsum dolor adipiscing</span>
                                        <span>do eiusmod tempors</span>
                                    </div>
                                    <span class="font-size-h1 font-weight-boldest text-dark">669
                                    <sup class="font-size-h3 font-weight-normal pl-1">$</sup></span>
                                    <!--begin::Mobile Pricing Table-->
                                    <div class="d-lg-none">
                                        <div class="bg-gray-100 py-3">
                                            <span class="font-weight-boldest">Number Of Users</span>
                                            <span>Unlimited</span>
                                        </div>
                                        <div class="py-3">
                                            <span class="font-weight-boldest">Domains</span>
                                            <span>100</span>
                                        </div>
                                        <div class="bg-gray-100 py-3">
                                            <span class="font-weight-boldest">Projects</span>
                                            <span>500</span>
                                        </div>
                                        <div class="py-3">
                                            <span class="font-weight-boldest">Storage</span>
                                            <span>Unlimited</span>
                                        </div>
                                        <div class="bg-gray-100 py-3">
                                            <span class="font-weight-boldest">Supporet</span>
                                            <span>Yes</span>
                                        </div>
                                        <div class="py-3">
                                            <span class="font-weight-boldest">Tutorials</span>
                                            <span>Yes</span>
                                        </div>
                                        <div class="bg-gray-100 py-3">
                                            <span class="font-weight-boldest">Cancelation</span>
                                            <span>Yes</span>
                                        </div>
                                    </div>
                                    <!--end::Mobile Pricing Table-->
                                    <div class="mt-7">
                                        <button type="button" class="btn btn-primary text-uppercase font-weight-bolder px-15 py-3">Purchase</button>
                                    </div>
                                </div>
                            </div>
                            <!-- end: Pricing-->
                        </div>
                    </div>
                </div>
                <div class="row justify-content-center mx-0 mb-15 d-none d-lg-flex">
                    <div class="col-11">
                        <!-- begin: Bottom Table-->
                        <div class="row bg-gray-100 py-5 font-weight-bold text-center">
                            <div class="col-3 text-left px-5 font-weight-boldest">Number Of Users</div>
                            <div class="col-3">Up to 10k</div>
                            <div class="col-3">Up to 100k</div>
                            <div class="col-3">Unlimited</div>
                        </div>
                        <div class="row bg-white py-5 font-weight-bold text-center">
                            <div class="col-3 text-left px-5 font-weight-boldest">Domains</div>
                            <div class="col-3">1</div>
                            <div class="col-3">20</div>
                            <div class="col-3">10</div>
                        </div>
                        <div class="row bg-gray-100 py-5 font-weight-bold text-center">
                            <div class="col-3 text-left px-5 font-weight-boldest">Projects</div>
                            <div class="col-3">5</div>
                            <div class="col-3">100</div>
                            <div class="col-3">500</div>
                        </div>
                        <div class="row bg-white py-5 font-weight-bold text-center">
                            <div class="col-3 text-left px-5 font-weight-boldest">Storage</div>
                            <div class="col-3">5GB</div>
                            <div class="col-3">200GB</div>
                            <div class="col-3">Unlimited</div>
                        </div>
                        <div class="row bg-gray-100 py-5 font-weight-bold text-center">
                            <div class="col-3 text-left px-5 font-weight-boldest">Supporet</div>
                            <div class="col-3">No</div>
                            <div class="col-3">Yes</div>
                            <div class="col-3">Yes</div>
                        </div>
                        <div class="row bg-white py-5 font-weight-bold text-center">
                            <div class="col-3 text-left px-5 font-weight-boldest">Tutorials</div>
                            <div class="col-3">No</div>
                            <div class="col-3">Yes</div>
                            <div class="col-3">Yes</div>
                        </div>
                        <div class="row bg-gray-100 py-5 font-weight-bold text-center">
                            <div class="col-3 text-left px-5 font-weight-boldest">Cancelation</div>
                            <div class="col-3">Yes</div>
                            <div class="col-3">Yes</div>
                            <div class="col-3">Yes</div>
                        </div>
                        <!-- end: Bottom Table-->
                    </div>
                </div>
            </section> --}}

            <section class="py-20" id="contact">
                <div class="container">
                    <div class="text-center mb-5">
                        <h2 class="display-5 mb-3"><b>Pronto para começar?</b></h2>
                        <p class="lead">Crie já sua conta, é de graça</p>
                    </div>

                    <div class="row justify-content-center align-items-center">
                        <div class='text-center'>
                            <a class="btn btn-success btn-lg mt-3" data-toggle="modal" data-target="#registerModal"><b>Criar um bolão</b></a>
                            <a class="btn btn-primary btn-lg mt-3" href="{{ route('web.boloes.listing') }}"><b>Comprar cotas</b></a>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div><!--end::Container-->
</div><!--end::Entry-->

@include('web.boloes.bolao_infos_modal')

<!-- Modal-->
<div class="modal fade" id="requestPlatformModal" data-backdrop="true" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="card card-custom gutter-b example example-compact">
                <div class="card-header ps-0 pe-0">
                    <h4 class="card-title ms-5"><img src="{{ asset('img/icon-lotos-facil.png') }}" class='me-2' />Solicitar plataforma</h4>
                    <button type="button" class="close ms-auto me-4" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
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