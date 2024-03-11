@extends('layouts.adm.adm')

@section('titlePage', 'Customers - Create')

@section('content')

    <div class="col-md-10" id="content-wrapper">
        <div class="row">
            <div class="col-lg-12">

                <div class="clearfix">
                    <h1 class="pull-left"><span class="fas fa-user-plus"></span> Add customer</h1>
                </div>

                <div class="row">
                    <div class="main-box">
                        <form method="post" role="form" action="{{ route('adm.customers.store') }}">
                            @csrf

                            <div class="form-group">
                                <div class="onoffswitch newsletterSwitch onoffswitch-success">
                                    <input type="checkbox" name="newsletter" value="1" class="onoffswitch-checkbox" id="myonoffswitch4" checked="checked">
                                    <label class="onoffswitch-label" for="myonoffswitch4">
                                        <div class="onoffswitch-inner"></div>
                                        <div class="onoffswitch-switch"></div>
                                    </label>
                                </div>
                            </div>

                            <div class="form-group {{ $errors->has('genre') ? 'has-error' : '' }}">
                                <label>
                                    <input type="radio" name="genre" value="1" {{ old('genre') == 1 || old('genre') === NULL     ? 'checked="checked"' : '' }}>
                                    Homem
                                </label>
                                <label class="ml-2">
                                    <input type="radio" name="genre" value="0" {{ old('genre') == 0 ? 'checked="checked"' : '' }}>
                                    Mulher
                                </label>
                            </div>

                            <div class='row'>
                                <div class="form-group col-xs-12 {{ $errors->has('full_name') ? 'has-error' : '' }}">
                                    <label>Nome Completo</label>
                                    <input type="text" name="full_name" class="form-control" placeholder="Nome Completo" value="{{ old('full_name') }}">
                                    <span class="help-block"><i class="icon-remove-sign"></i> {{ $errors->first('full_name') }}</span>
                                </div>
                            </div>

                            <div class="form-group {{ $errors->has('cpf') ? 'has-error' : '' }}">
                                <label>CPF</label>
                                <input type="text" name="cpf" class="form-control maskCpf" placeholder="xxx.xxx.xxx-xx" value="{{ old('cpf') }}">
                                <span class="help-block"><i class="icon-remove-sign"></i> {{ $errors->first('cpf') }}</span>
                            </div>

                            <div class="form-group {{ $errors->has('cnpj') ? 'has-error' : '' }}">
                                <label>CNPJ</label>
                                <input type="text" name="cnpj" class="form-control maskCnpj" placeholder="xx.xxx.xxx/xxxx-xx" value="{{ old('cnpj') }}">
                                <span class="help-block"><i class="icon-remove-sign"></i> {{ $errors->first('cnpj') }}</span>
                            </div>

                            <div class="form-group {{ $errors->has('phone') ? 'has-error' : '' }}">
                                <label>Phone</label>
                                <input type="text" name="phone" class="form-control maskPhone" placeholder="Phone" value="{{ old('phone') }}">
                                <span class="help-block"><i class="icon-remove-sign"></i> {{ $errors->first('phone') }}</span>
                            </div>

                            <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
                                <label for="exampleInputEmail1">Email</label>
                                <input type="email" name="email" class="form-control" placeholder="Enter email" value="{{ old('email') }}">
                                <span class="help-block"><i class="icon-remove-sign"></i> {{ $errors->first('email') }}</span>
                            </div>

                            <div class="form-group {{ $errors->has('password') ? 'has-error' : '' }}">
                                <label for="exampleInputPassword1">Password</label>
                                <input type="password" name="password" class="form-control pwstrength" placeholder="Password" data-indicator="pwindicator">
                                <span class="help-block"><i class="icon-remove-sign"></i> {{ $errors->first('password') }}</span>
                                <div id='pwindicator' class="pwdindicator">
                                    <div class="bar"></div>
                                    <div class="pwdstrength-label"></div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="exampleInputPassword1">Confirm password</label>
                                <input type="password" name="password_confirmation" class="form-control" placeholder="Password">
                            </div>

                            <button type="submit" class="btn btn-lg btn-success">Save</button>
                        </form>
                    </div>
                </div>


            </div>
        </div>
    </div>

@endsection