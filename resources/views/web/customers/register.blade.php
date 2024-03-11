@extends('layouts.web.web')

@push('styles')
    <link href="{{ asset('css/customers.css') }}" type="text/css" rel="stylesheet" />
@endpush


@section('titlePage', 'Cadastre-se na nossa plataforma ' . env('APP_NAME') . ' e amplie suas chances de vitória!')
@section('descriptionPage', 'Cadastre-se agora em nossa plataforma para começar a maximizar seus ganhos e vender as cotas dos seu bolão - além de concorrer a prêmios da loteria! Não perca a chance e cadastre-se agora mesmo!')

@section('content')

<div id="customer-register" class="d-flex flex-column-fluid mt-5">
    <!--begin::Container-->
    <div class="container">
        <!--begin::Card-->
        <div class="card card-custom rounded-top-0">
            <!--begin::Body-->
            <div class="card-body">
                <div class="col-xl-12">
                    <h1>Cadastre-se</h1>
                
                    @include('web.includes.alert')

                    <!--begin::Form-->
                    <form id='RegisterForm' data-url="{{ route('web.customers.store') }}" method="POST" class="form form-ajax" redirect='1'>
                        {{ csrf_field() }}

                        <div class="card-body">

                            <div class="alert d-none mb-5"></div>

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
                        </div>
                    </form>
                    <!--end::Form-->
                </div>
            </div>
        </div>
    </div>
</div>

@endsection