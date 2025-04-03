@extends('layouts.web.web')

@section('titlePage', 'Alterar Dados | ' . env('APP_NAME'))
@section('descriptionPage', 'Acesse sua conta para alterar seus dados.')

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
                        <form id='EditForm' action="{{ route('web.customers.update') }}" method="POST" class="form pt-2 pb-5" enctype="multipart/form-data">
                            {{ csrf_field() }}

                            <div class="card-body">
                                @include('web.includes.alert_errorsbag')

                                <div class="form-group row p-1">
                                    <div class="col-lg-12">
                                        <!-- <label><strong>Foto do Perfil:</strong></label> -->
                                        <div class="col-lg-9 col-xl-6">
                                            <div class="image-input image-input-outline image-input-circle" id="kt_image_3">
                                                @if($customer->profile_image)
                                                    <div class="image-input-wrapper" style="background-image: url({{ asset('img/profile_images/' . $customer->profile_image) }})"></div>
                                                @else
                                                    <div class="image-input-wrapper mb-4" style="background-image: url({{ asset('img/no-profile-image.png') }}); "></div>
                                                @endif
                                                <label class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="change" data-toggle="tooltip" title="" data-original-title="Change avatar">
                                                    <i class="fa fa-pen icon-sm text-muted"></i>
                                                    <input type="file" name="profile_image">
                                                    <input type="hidden" name="profile_image_remove">
                                                </label>
                                                <span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="cancel" data-toggle="tooltip" title="" data-original-title="Cancel avatar">
                                                    <i class="ki ki-bold-close icon-xs text-muted"></i>
                                                </span>
                                            </div>
                                            <span class="form-text text-muted">Tamanho recomendado: 150x150.</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row p-1">
                                    <div class="col-lg-12">
                                        <label><strong>Nome Completo:</strong></label>
                                        <input type="text" name="full_name" class="form-control" value="{{ $customer->full_name }}" />
                                    </div>
                                </div>
                                <div class="form-group row p-1">
                                    <div class="col-lg-6">
                                        <label><strong>Nome do Perfil:</strong></label>
                                        <input type="text" name="profile_name" class="form-control" value="{{ $customer->profile_name }}" />
                                    </div>
                                    <div class="col-lg-6">
                                        <label><strong>Email*:</strong></label>
                                        <input type="email" name="email" class="form-control" value="{{ $customer->email }}" />
                                    </div>
                                </div>
                                <div class="form-group row p-1">
                                    <div class="col-lg-6">
                                        <label><strong>CPF:</strong></label>
                                        <input type="text" name="cpf" class="form-control maskCpf" value="{{ $customer->cpf }}" />
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