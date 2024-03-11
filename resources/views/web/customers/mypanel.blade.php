@extends('layouts.web.web')

@section('titlePage', 'Meu Painel')

@section('content')

@include('web.customers.register_modal')
@include('web.customers.login_modal')

<!--begin::Entry-->
<div class="d-flex flex-column-fluid mt-5" id='user-profile'>
    <!--begin::Container-->
    <div class="container">
        <div class="col-lg-12">
            <div class="main-box clearfix">
                <div class="profile-header">
                    <h3><span>Meu Perfil</span></h3>
                </div><!-- /profile-header -->

                @include('web.customers.menu')
                
                <div class="row profile-user-info">
                    <form id='EditForm' data-url="{{ route('web.customers.update') }}" method="POST" class="form form-ajax pt-2 pb-5" redirect='0'>
                        {{ csrf_field() }}

                        <div class="card-body">
                            <div class="alert d-none mb-2"></div>

                            <div class="form-group row p-1">
                                <div class="col-lg-12">
                                    <div class="checkbox-single">
                                        <label class="checkbox">
                                            <input type="checkbox" name="newsletter" {{ $customer->newsletter ? 'checked="checked"' : '' }} value='1'>Newsletter
                                            <span></span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row p-1">
                                <div class="col-lg-6">
                                    <label><strong>Nome:</strong></label>
                                    <input type="text" name="first_name" class="form-control" value="{{ $customer->first_name }}" />
                                </div>
                                <div class="col-lg-6">
                                    <label><strong>Sobrenome:</strong></label>
                                    <input type="text" name="last_name" class="form-control" value="{{ $customer->last_name }}" />
                                </div>
                            </div>
                            <div class="form-group row p-1">
                                <div class="col-lg-12">
                                    <label><strong>Email:</strong></label>
                                    <input type="email" name="email" class="form-control" value="{{ $customer->email }}" />
                                </div>
                            </div>
                            <div class="form-group row p-1">
                                <div class="col-lg-6">
                                    <label><strong>CPF:</strong></label>
                                    <input type="text" name="cpf" class="form-control" value="{{ $customer->cpf }}" />
                                </div>
                                <div class="col-lg-6">
                                    <label><strong>CNPJ:</strong></label>
                                    <input type="text" name="cnpj" class="form-control" value="{{ $customer->cnpj }}" />
                                </div>
                            </div>
                            <div class="form-group row p-1">
                                <div class="col-lg-6">
                                    <label><strong>Senha:</strong></label>
                                    <input type="password" name="password" class="form-control" />
                                </div>
                                <div class="col-lg-6">
                                    <label><strong>Confirmar Senha:</strong></label>
                                    <input type="password" name="password_confirmation" class="form-control" />
                                </div>
                            </div>
                            <div class="form-group row p-5">
                                <button class="btn btn-success mr-2 btn-send"><strong>Salvar</strong></button>
                            </div>
                    </form>
                </div><!-- /profile-user-info -->    
            </div><!-- /main-box -->
        </div>
    </div>
    <!--end::Container-->
</div>
<!--end::Entry-->

@endsection