@extends('layouts.adm.adm')

@section('titlePage', 'Concursos - Edit')

@section('content')

<div class="col-md-10" id="content-wrapper">
    <div class="row">
        <div class="col-lg-12">

            <div class="clearfix">
                <h1 class="pull-left"><span class="far fa-star"></span> Editar concurso</h1>
            </div>

            @include('adm.elements.alert')

            <div class="row">
                <div class="main-box">
                    <form method="post" role="form" action="{{ route('adm.concursos.update', [$concurso->id]) }}">
                        @csrf
                        @method('patch')

                        <div class="form-group clearfix">
                            <div class='pull-left'>
                                <div class="onoffswitch onoffswitch-success">
                                    <input type="checkbox" name="active" value="1" class="onoffswitch-checkbox" id="myonoffswitch3" {{ $concurso->active ? 'checked="checked"' : '' }}>
                                    <label class="onoffswitch-label" for="myonoffswitch3">
                                        <div class="onoffswitch-inner"></div>
                                        <div class="onoffswitch-switch"></div>
                                    </label>
                                </div>
                            </div>

                            <div class="form-group pull-left">
                                <a href='{{ route("adm.concursos.check", [$concurso->id]) }}' class='btn btn-primary'>Conferir Bolões</a>
                            </div>
                        </div>

                        <div class="form-group {{ $errors->has('lotery_id') ? 'has-error' : '' }}">
                            <label>Loteria</label>
                            <select class="form-control select2" name="lotery_id">
                                <option value="" {{ $concurso->lotery_id == '' ? 'selected="selected"' : '' }}>Selecione a loteria</option>

                                @foreach($loteries as $lotery)
                                    <option value="{{ $lotery->id }}" {{ $concurso->lotery_id == $lotery->id ? 'selected="selected"' : '' }}>{{ $lotery->name }}</option>
                                @endforeach
                            </select>
                            <span class="help-block"><i class="icon-remove-sign"></i> {{ $errors->first('lotery_id') }}</span>
                        </div>

                        <div class="form-group {{ $errors->has('type') ? 'has-error' : '' }}">
                            <label>Tipo</label>
                            <select class="form-control select2" name="type">
                                <option value="" {{ $concurso->type == '' ? 'selected="selected"' : '' }}>Selecione o tipo</option>
                                <option value="1" {{ $concurso->type == 1 ? 'selected="selected"' : '' }}>Normal</option>
                                <option value="2" {{ $concurso->type == 2 ? 'selected="selected"' : '' }}>Especial</option>
                                <option value="3" {{ $concurso->type == 3 ? 'selected="selected"' : '' }}>Acumulado</option>
                            </select>
                            <span class="help-block"><i class="icon-remove-sign"></i> {{ $errors->first('type') }}</span>
                        </div>

                        <div class="form-group {{ $errors->has('number') ? 'has-error' : '' }}">
                            <label>Número do Concurso</label>
                            <input type="number" name="number" class="form-control" placeholder="Número" value="{{ $concurso->number }}">
                            <span class="help-block"><i class="icon-remove-sign"></i> {{ $errors->first('number') }}</span>
                        </div>

                        <div class="form-group {{ $errors->has('draw_day') ? 'has-error' : '' }}">
                            <label>Data do sorteio</label>
                            <input type="text" name="draw_day" class="form-control datepicker maskDate" placeholder="Dia do sorteio" value="{{ $concurso->getDrawDay() }}">
                            <span class="help-block"><i class="icon-remove-sign"></i> {{ $errors->first('draw_day') }}</span>
                        </div>

                        <div class="form-group {{ $errors->has('next_expected_prize') ? 'has-error' : '' }}">
                            <label>Prêmio estimado</label>
                            <div class="input-group">
                                <span class="input-group-addon">R$</span>
                                <input type="text" name="next_expected_prize" class="form-control maskMoney" placeholder="Prêmio estimado" value="{{ $concurso->getNextExpectedPrize(false) }}">
                            </div>
                            <span class="help-block"><i class="icon-remove-sign"></i> {{ $errors->first('next_expected_prize') }}</span>
                        </div>

                        <div class="form-group {{ $errors->has('value_accumulated') ? 'has-error' : '' }}">
                            <label>Valor acumulado</label>
                            <div class="input-group">
                                <span class="input-group-addon">R$</span>
                                <input type="text" name="value_accumulated" class="form-control maskMoney" placeholder="Valor acumulado" value="{{ $concurso->value_accumulated }}">
                            </div>
                            <span class="help-block"><i class="icon-remove-sign"></i> {{ $errors->first('value_accumulated') }}</span>
                        </div>

                        <p>&nbsp;</p>

                        @include('adm.concursos.results.' . $concurso->lotery->getSlug())

                        <button type="submit" class="btn btn-lg btn-success">Salvar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection