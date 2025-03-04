@extends('layouts.web.web')

@section('titlePage', 'Alterar dados')

@section('content')

@include('web.customers.register_modal')
@include('web.customers.login_modal')

<!--begin::Entry-->
<div class="d-flex flex-column-fluid mt-5" id='user-profile'>
    <!--begin::Container-->
    <div class="container">
        <div class="col-lg-12">
            <div class="main-box clearfix">
                <h1 class='ps-0 mb-8 text-primary'><b>Alterar dados</b></h1>

                {{-- @include('web.customers.menu') --}}
                
                <div class="row profile-user-info mt-8">
                    <div class='col-lg-12'>
                        <form id='EditForm' data-url="{{ route('web.customers.update') }}" method="POST" class="form form-ajax pt-2 pb-5" redirect='0'>
                            {{ csrf_field() }}

                            <div class="card-body">
                                <div class="alert d-none mb-2"></div>

                                <div class="form-group row p-1">
                                    <div class="col-lg-12">
                                        <label><strong>Nome Completo:</strong></label>
                                        <input type="text" name="full_name" class="form-control" value="{{ $customer->full_name }}" />
                                    </div>
                                </div>
                                <div class="form-group row p-1">
                                    <div class="col-lg-12">
                                        <label><strong>Email*:</strong></label>
                                        <input type="email" name="email" class="form-control" value="{{ $customer->email }}" />
                                    </div>
                                </div>
                                <div class="form-group row p-1">
                                    <div class="col-lg-6">
                                        <label><strong>CPF:</strong></label>
                                        <input type="text" name="cpf" class="form-control" value="{{ $customer->cpf }}" />
                                    </div>
                                    <div class="col-lg-6">
                                        <label><strong>Data de nascimento*:</strong></label>
                                        <input type="text" name="birthday_date" class="form-control maskBirthday" value="{{ $customer->getBirthdayDate() }}" />
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
                                <div class="form-group col-md-3 ps-1 mt-3">
                                    <button class="btn btn-success mr-2 btn-send"><strong>Salvar</strong></button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div><!-- /profile-user-info -->    
            </div><!-- /main-box -->
        </div>
    </div>
    <!--end::Container-->
</div>
<!--end::Entry-->

@endsection