@extends('layouts.adm.adm')

@section('titlePage', 'Customers - Edit')

@section('content')

    <div class="col-md-10" id="content-wrapper">
        <div class="row">
            <div class="col-lg-12">

                <div class="clearfix">
                    <h1 class="pull-left"><span class="fas fa-user-edit"></span> Edit customer</h1>
                </div>

                @include('adm.elements.alert')

                <div class="row">
                    <div class="main-box">
                        <form method="post" role="form" action="{{ route('adm.customers.update', [$customer->id]) }}">
                            @csrf
                            @method('patch')

                            <div class="form-group">
                                <div class="onoffswitch onoffswitch-success">
                                    <input type="checkbox" name="active" value="1" class="onoffswitch-checkbox" id="myonoffswitch3" {{ $customer->active ? 'checked="checked"' : '' }}>
                                    <label class="onoffswitch-label" for="myonoffswitch3">
                                        <div class="onoffswitch-inner"></div>
                                        <div class="onoffswitch-switch"></div>
                                    </label>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="onoffswitch newsletterSwitch onoffswitch-success">
                                    <input type="checkbox" name="newsletter" value="1" class="onoffswitch-checkbox" id="myonoffswitch" {{ $customer->newsletter ? 'checked="checked"' : '' }}>
                                    <label class="onoffswitch-label" for="myonoffswitch">
                                        <div class="onoffswitch-inner"></div>
                                        <div class="onoffswitch-switch"></div>
                                    </label>
                                </div>
                            </div>

                            <div class="form-group {{ $errors->has('genre') ? 'has-error' : '' }}">
                                <label>
                                    <input type="radio" name="genre" value="1" {{ $customer->genre == 1 || $customer->genre === NULL  ? 'checked="checked"' : '' }}>
                                    Homem
                                </label>
                                <label class="ml-2">
                                    <input type="radio" name="genre" value="0" {{ $customer->genre == 0 ? 'checked="checked"' : '' }}>
                                    Mulher
                                </label>
                            </div>

                            <div class='row'>
                                <div class="form-group col-xs-12 {{ $errors->has('full_name') ? 'has-error' : '' }}">
                                    <label>Data de cadastro</label><br />
                                    {{ $customer->getCreatedAtFormatted(false) }}
                                </div>
                            </div>

                            <div class='row'>
                                <div class="form-group col-xs-12 {{ $errors->has('full_name') ? 'has-error' : '' }}">
                                    <label>Idade</label><br />
                                    {{ $customer->getAge() }}
                                </div>
                            </div>

                            <div class='row'>
                                <div class="form-group col-xs-12 {{ $errors->has('full_name') ? 'has-error' : '' }}">
                                    <label>Créditos</label><br />
                                    {{ $customer->getFormattedCredits() }}
                                </div>
                            </div>

                            <div class='row'>
                                <div class="form-group col-xs-12 {{ $errors->has('full_name') ? 'has-error' : '' }}">
                                    <label>Nome</label>
                                    <input type="text" name="full_name" class="form-control" placeholder="Nome Completo" value="{{ $customer->full_name }}">
                                    <span class="help-block"><i class="icon-remove-sign"></i> {{ $errors->first('full_name') }}</span>
                                </div>
                            </div>

                            <div class="form-group {{ $errors->has('cpf') ? 'has-error' : '' }}">
                                <label>CPF</label>
                                <input type="text" name="cpf" class="form-control maskCpf" placeholder="xxx.xxx.xxx-xx" value="{{ $customer->cpf }}">
                                <span class="help-block"><i class="icon-remove-sign"></i> {{ $errors->first('cpf') }}</span>
                            </div>

                            <!-- <div class="form-group {{ $errors->has('cnpj') ? 'has-error' : '' }}">
                                <label>CNPJ</label>
                                <input type="text" name="cnpj" class="form-control maskCnpj" placeholder="xx.xxx.xxx/xxxx-xx" value="{{ $customer->cnpj }}">
                                <span class="help-block"><i class="icon-remove-sign"></i> {{ $errors->first('cnpj') }}</span>
                            </div> -->

                            <div class="form-group {{ $errors->has('phone') ? 'has-error' : '' }}">
                                <label>Phone</label>
                                <input type="text" name="phone" class="form-control maskPhone" placeholder="Phone" value="{{ $customer->phone }}">
                                <span class="help-block"><i class="icon-remove-sign"></i> {{ $errors->first('phone') }}</span>
                            </div>

                            <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
                                <label for="exampleInputEmail1">Email</label>
                                <input type="email" name="email" class="form-control" disabled placeholder="Enter email" value="{{ $customer->email }}">
                                <span class="help-block"><i class="icon-remove-sign"></i> {{ $errors->first('email') }}</span>
                            </div>

                            <button type="submit" class="btn btn-lg btn-success">Save</button>
                        </form>
                    </div>
                </div>

                <div class="clearfix">
                    <h2 class="pull-left"><span class="fas fa-money-check-alt"></span> Bolões</h2>
                </div><!-- /clearfix -->

                <div class="row">
                    <div class="main-box clearfix">
                        <div class="col-lg-12">
                            @if($customer->boloes()->count() <= 0)
                                <div class="alert alert-warning">
                                    <i class="fas fa-exclamation-triangle fa-fw fa-lg"></i> There are no boloes for this user
                                </div>
                            @else
                                @include('adm.customers.boloes_listing')
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection