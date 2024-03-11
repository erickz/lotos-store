@extends('layouts.adm.adm')

@section('titlePage', 'Customers Bank Account - Create')

@section('content')

    <div class="col-md-10" id="content-wrapper">
        <div class="row">
            <div class="col-lg-12">

                <div class="clearfix">
                    <h1 class="pull-left"><span class="fas fa-money-check-alt"></span> Add bank account</h1>
                </div>

                <div class="row">
                    <div class="main-box">
                        <form method="post" role="form" action="{{ route('adm.customers.bank.store', [$customer->id]) }}">
                            @csrf

                            <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                                <label>Bearer</label>
                                <input type="text" name="bearer" class="form-control" placeholder="Bearer" value="{{ old('bearer') }}">
                                <span class="help-block"><i class="icon-remove-sign"></i> {{ $errors->first('bearer') }}</span>
                            </div>

                            <div class="form-group {{ $errors->has('agency') ? 'has-error' : '' }}">
                                <label>Agency</label>
                                <input type="text" maxlength="5" name="agency" class="form-control" placeholder="Agency" value="{{ old('agency') }}">
                                <span class="help-block"><i class="icon-remove-sign"></i> {{ $errors->first('agency') }}</span>
                            </div>

                            <div class="form-group {{ $errors->has('account_number') ? 'has-error' : '' }}">
                                <label>Account Number</label>
                                <input type="text" name="account_number" class="form-control" placeholder="Account Number" value="{{ old('account_number') }}">
                                <span class="help-block"><i class="icon-remove-sign"></i> {{ $errors->first('account_number') }}</span>
                            </div>

                            <div class="form-group {{ $errors->has('bank') ? 'has-error' : '' }}">
                                <label>Bank</label>
                                <input type="text" name="bank" class="form-control" placeholder="Bank" value="{{ old('bank') }}">
                                <span class="help-block"><i class="icon-remove-sign"></i> {{ $errors->first('bank') }}</span>
                            </div>

                            <div class="form-group {{ $errors->has('type') ? 'has-error' : '' }}">
                                <label>Type</label>
                                <select class="form-control select" name="type">
                                    <option value="" {{ old('type') == '' ? 'selected="selected"' : '' }}>Selecione o tipo de conta</option>
                                    <option value="cc" {{ old('type') == 'cc' ? 'selected="selected"' : '' }}>Conta corrente</option>
                                    <option value="cp" {{ old('type') == 'cp' ? 'selected="selected"' : '' }}>Conta poupança</option>
                                </select>
                                <span class="help-block"><i class="icon-remove-sign"></i> {{ $errors->first('type') }}</span>
                            </div>

                            <div class="form-group {{ $errors->has('code_bank') ? 'has-error' : '' }}">
                                <label>Code bank</label>
                                <input type="text" name="code_bank" class="form-control" placeholder="Code Bank" value="{{ old('code_bank') }}">
                                <span class="help-block"><i class="icon-remove-sign"></i> {{ $errors->first('code_bank') }}</span>
                            </div>

                            <button type="submit" class="btn btn-lg btn-success">Save</button>
                        </form>
                    </div>
                </div>


            </div>
        </div>
    </div>

@endsection