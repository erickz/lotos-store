@extends('layouts.web.web')

@section('titlePage', 'Você ganhou cotas! Cadastre-se ou faça login para recebe-las')
@section('descriptionPage', 'Nesta página você confirma seus dados e procede para receber as cotas que você recebeu de presente!')

@section('content')

<div id="customer-register" class="d-flex flex-column-fluid mt-5">
    <!--begin::Container-->
    <div class="container">
        <!--begin::Card-->
        <div class="card card-custom rounded-top-0">
            <!--begin::Body-->
            <div class="card-body">
                <div class="col-xl-12">
                    <h1 class='ps-0 color-default mb-0'><b>Você ganhou {{ $invite->cotas }} cota{{ $invite->cotas > 1 ? 's' : '' }} de {{ $invite->owner->getFirstName() }}! </b></h1>
                    <h2 class='color-default ps-0 pt-0'><b>Login ou cadastre-se para receber suas cotas</b></h2>
                
                    <div class="alert {{ isset($message) && $message ? 'alert-warning' : '' }} mb-5 ps-0">
                        @if($message)
                            <div class="alert-icon d-inline">
                                <i class="fas fa-info-circle fa-fw fa-lg text-warning"></i>
                            </div>
                            <div class="text-warning d-inline">
                                {{ $message }}
                            </div>
                        @else
                            <div class="alert-icon d-inline">
                                <i class="fas fa-info-circle fa-fw fa-lg text-primary"></i>
                            </div>
                            <div class="text-primary d-inline">
                                Faça login ou cadastre-se para receber as sua cotas do Bolão da {{ $invite->bolao->lotery->name }} e concorrer a <b>{{ $invite->bolao->concurso->getFormattedNextExpectedPrize() }}!</b>
                            </div>
                        @endif
                    </div>

                    <div class='d-flex d-flex-responsive mt-5'>
                        <div class='col me-15 border-end pe-15'>
                            <h2 class='p-0'><b>Login</b></h2>
                            <div class=''>
                                <form id='loginForm' data-url="{{ route('web.customers.login') }}" method="POST" class="form form-ajax mt-5" redirect='1'>
                                    
                                    {{ csrf_field() }}

                                    <input type='hidden' name='redirectTo' value='{{ route("web.customers.claimInvite", [$invite->id]) }}' />
                                    
                                    <div class="alert d-none mb-5"></div>

                                    <div class="form-group row">
                                        <div class="col-lg-12">
                                            <label><strong>Email:</strong></label>
                                            <input type="email" name="email" required class="form-control" value="{{ old('email') }}" />
                                        </div>
                                    </div>
                                    <div class="form-group row mt-5">
                                        <div class="col-lg-12">
                                            <label><strong>Senha:</strong></label>
                                            <input type="password" name="password" required class="form-control" />
                                        </div>
                                    </div>
                                    <div class="form-group row mt-5">
                                        <div class="col-lg-12 text-end">
                                            <button class="btn btn-primary w-100 mr-2 btn-send"><strong>Entrar</strong></button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class='col'>
                            <h2 class='p-0'><b>Registre-se</b></h2>

                            <form id='RegisterForm' data-url="{{ route('web.customers.store') }}" method="POST" class="form form-ajax mt-5" redirect='1'>
                                {{ csrf_field() }}

                                <div class="alert d-none"></div>

                                <input type='hidden' name='redirectTo' value='{{ route("web.customers.claimInvite", [$invite->id]) }}' />

                                <div class="form-group row p-1">
                                    <div class="col-lg-12">
                                        <label><strong>Nome Completo*:</strong></label>
                                        <input type="text" name="full_name" class="form-control" value="{{ old('full_name') }}" />
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
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection