@extends('layouts.checkout.checkout')

@section('titlePage', 'Login ou cadastre-se para realizar sua compra!')

@section('content')

<!--begin::Entry-->
<div class="d-flex flex-column-fluid mt-5">
    <!--begin::Container-->
    <div class="container">
        <div class="row cartListing identificationCheckout">
            <div class='col-lg-12'>
                @include('web.payments.menu')

                <div class="alert d-none"></div>
                
                <div class='d-flex d-flex-responsive bg-white p-5 mt-5 shadow-sm rounded'>
                    <div class='col me-15 border-end pe-15'>
                        <h1 class='p-0 text-primary'><b>Faça seu login</b></h1>
                        <div class=''>
                            <form id='loginForm' data-url="{{ route('web.customers.login') }}" method="POST" class="form form-ajax mt-5" redirect='1'>
                                
                                {{ csrf_field() }}

                                <input type='hidden' name='redirectTo' value='{{ route("web.payments.index") }}' />

                                <div class="card-body">
                                
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
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class='col'>
                        <h2 class='p-0 text-primary'><b>Registre-se</b></h2>

                        <form id='RegisterForm' data-url="{{ route('web.customers.store') }}" method="POST" class="form form-ajax mt-5" redirect='1'>
                            {{ csrf_field() }}

                            <div class="alert d-none"></div>

                            <input type='hidden' name='redirectTo' value='{{ route("web.payments.index") }}' />

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
            </div><!-- /col-lg-12 -->
        </div><!-- /boloesListing -->
    </div><!--end::Container-->
</div><!--end::Entry-->

@include('web.customers.login_modal')

@endsection