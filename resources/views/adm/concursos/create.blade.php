@extends('layouts.adm.adm')

@section('titlePage', 'Concursos - Create')

@section('content')

<div class="col-md-10" id="content-wrapper">
    <div class="row">
        <div class="col-lg-12">

            <div class="clearfix">
                <h1 class="pull-left"><span class="far fa-star"></span> Add Concurso</h1>
            </div>

            <div class="row">
                <div class="main-box">
                    <form method="post" role="form" action="{{ route('adm.concursos.store') }}">
                        @csrf

                        <div class="form-group">
                            <div class="onoffswitch onoffswitch-success">
                                <input type="checkbox" name="active" value="1" class="onoffswitch-checkbox" id="myonoffswitch3" {{ old('active') ? old('active') : 'checked="checked"' }}>
                                <label class="onoffswitch-label" for="myonoffswitch3">
                                    <div class="onoffswitch-inner"></div>
                                    <div class="onoffswitch-switch"></div>
                                </label>
                            </div>
                        </div>

                        <div class="form-group {{ $errors->has('lotery_id') ? 'has-error' : '' }}">
                            <label>Loteria</label>
                            <select class="form-control select2" name="lotery_id">
                                <option value="" {{ old('lotery_id') == '' ? 'selected="selected"' : '' }}>Selecione a loteria</option>

                                @foreach($loteries as $lotery)
                                    <option value="{{ $lotery->id }}" {{ old('lotery_id') == $lotery->id ? 'selected="selected"' : '' }}>{{ $lotery->name }}</option>
                                @endforeach
                            </select>
                            <span class="help-block"><i class="icon-remove-sign"></i> {{ $errors->first('lotery_id') }}</span>
                        </div>

                        <div class="form-group {{ $errors->has('type') ? 'has-error' : '' }}">
                            <label>Tipo</label>
                            <select class="form-control select2" name="type">
                                <option value="" {{ old('type') == '' ? 'selected="selected"' : '' }}>Selecione o tipo</option>
                                <option value="1" {{ old('type') == 1 ? 'selected="selected"' : '' }}>Normal</option>
                                <option value="2" {{ old('type') == 2 ? 'selected="selected"' : '' }}>Especial</option>
                                <option value="3" {{ old('type') == 3 ? 'selected="selected"' : '' }}>Acumulado</option>
                            </select>
                            <span class="help-block"><i class="icon-remove-sign"></i> {{ $errors->first('type') }}</span>
                        </div>

                        <div class="form-group {{ $errors->has('number') ? 'has-error' : '' }}">
                            <label>Número do Concurso</label>
                            <input type="number" name="number" class="form-control" placeholder="Número" value="{{ old('number') }}">
                            <span class="help-block"><i class="icon-remove-sign"></i> {{ $errors->first('number') }}</span>
                        </div>

                        <div class="form-group {{ $errors->has('draw_day') ? 'has-error' : '' }}">
                            <label>Data do sorteio</label>
                            <input type="text" name="draw_day" class="form-control datepicker maskDate" placeholder="Dia do sorteio" value="{{ old('draw_day') }}">
                            <span class="help-block"><i class="icon-remove-sign"></i> {{ $errors->first('draw_day') }}</span>
                        </div>

                        <div class="form-group {{ $errors->has('next_expected_prize') ? 'has-error' : '' }}">
                            <label>Prêmio estimado</label>
                            <div class="input-group">
                                <span class="input-group-addon">R$</span>
                                <input type="text" name="next_expected_prize" class="form-control maskMoney" placeholder="Prêmio estimado" value="{{ old('next_expected_prize') }}">
                            </div>
                            <span class="help-block"><i class="icon-remove-sign"></i> {{ $errors->first('next_expected_prize') }}</span>
                        </div>

                        <div class="form-group {{ $errors->has('value_accumulated') ? 'has-error' : '' }}">
                            <label>Valor acumulado</label>
                            <div class="input-group">
                                <span class="input-group-addon">R$</span>
                                <input type="text" name="value_accumulated" class="form-control maskMoney" placeholder="Valor acumulado" value="{{ old('value_accumulated') }}">
                            </div>
                            <span class="help-block"><i class="icon-remove-sign"></i> {{ $errors->first('value_accumulated') }}</span>
                        </div>

                        <button type="submit" class="btn btn-lg btn-success">Criar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection