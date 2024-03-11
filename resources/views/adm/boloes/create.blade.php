@extends('layouts.adm.adm')

@section('titlePage', 'Boloes - Create')

@section('content')

<div class="col-md-10" id="content-wrapper">
    <div class="row">
        <div class="col-lg-12">

            <div class="clearfix">
                <h1 class="pull-left"><span class="fas fa-plus-circle"></span> Add Bolões</h1>
            </div><!-- /clearfix -->

            <div class="row">
                <div class="main-box">
                    <form method="post" role="form" action="{{ route('adm.boloes.store') }}">
                        @csrf

                        <div class="form-group">
                            <div class="onoffswitch onoffswitch-success">
                                <input type="checkbox" name="active" value="1" class="onoffswitch-checkbox" id="myonoffswitch3" {{ old('active') ? 'checked="checked"' : 'checked="checked"' }}>
                                <label class="onoffswitch-label" for="myonoffswitch3">
                                    <div class="onoffswitch-inner"></div>
                                    <div class="onoffswitch-switch"></div>
                                </label>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="onoffswitch featuredSwitch onoffswitch-success">
                                <input type="checkbox" name="featured" value="1" class="onoffswitch-checkbox" id="myonoffswitch" {{ old('featured') ? 'checked="checked"' : '' }}>
                                <label class="onoffswitch-label" for="myonoffswitch">
                                    <div class="onoffswitch-inner"></div>
                                    <div class="onoffswitch-switch"></div>
                                </label>
                            </div>
                        </div>

                        <div class="form-group {{ $errors->has('concurso_id') ? 'has-error' : '' }}">
                            <label>Concurso</label>
                            <select class="form-control select2" name="concurso_id">
                                <option value="" {{ old('concurso_id') == '' ? 'selected="selected"' : '' }}>Selecione a concurso</option>

                                @foreach($concursosList as $lotery => $concursos)
                                    <optgroup label="{{ ucwords(str_replace('-', ' ', $lotery)) }}">
                                        @foreach($concursos as $concurso)
                                            <option value="{{ $concurso->id }}" {{ old('concurso_id') == $concurso->id ? 'selected="selected"' : '' }}>#{{ $concurso->number }} - {{ $concurso->getDrawDay() }}</option>
                                        @endforeach
                                    </optgroup>
                                @endforeach
                            </select>
                            <span class="help-block"><i class="icon-remove-sign"></i> {{ $errors->first('concurso_id') }}</span>
                        </div>

                        <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                            <label>Nome do bolão</label>
                            <input type="text" name="name" class="form-control" placeholder="Nome" value="{{ old('name') }}">
                            <span class="help-block"><i class="icon-remove-sign"></i> {{ $errors->first('name') }}</span>
                        </div>

                        <div class="col-lg-6 pl-0">
                            <div class="form-group {{ $errors->has('cotas') ? 'has-error' : '' }}">
                                <label>Cotas</label>
                                <input type="number" name="cotas" id="cotaInput" class="form-control" placeholder="Número" value="{{ old('cotas') ? old('cotas') : '1' }}">
                                <span class="help-block"><i class="icon-remove-sign"></i> {{ $errors->first('cotas') }}</span>
                            </div>
                        </div><!-- /col-lg-6 -->

                        <div class="col-lg-6">
                            <div class="form-group {{ $errors->has('cotas_available') ? 'has-error' : '' }}">
                                <label>Cotas disponíveis</label>
                                <input type="number" name="cotas_available" class="form-control" placeholder="Número" value="{{ old('cotas_available') ? old('cotas_available') : '1' }}">
                                <span class="help-block"><i class="icon-remove-sign"></i> {{ $errors->first('cotas_available') }}</span>
                            </div>
                        </div><!-- /col-lg-6 -->

                        <div class="form-group {{ $errors->has('price') ? 'has-error' : '' }}">
                            <label>Preço da cota</label>
                            <div class="input-group">
                                <span class="input-group-addon">R$</span>
                                <input type="text" name="price" id='cotaPriceInput' class="form-control maskMoney" placeholder="Preço da cota" value="{{ old('price') }}">
                            </div>
                            <span class="help-block"><i class="icon-remove-sign"></i> {{ $errors->first('price') }}</span>
                        </div><!-- /form-group -->

                        {{--<div class="col-lg-6 pl-0">--}}
                            {{--<div class="form-group">--}}
                                {{--<label>Arrecadação máxima</label>--}}
                                {{--<input type="text" id="revenueInput" class="form-control maskPrice" disabled="disabled" placeholder="Arrecadação máxima" />--}}
                            {{--</div><!-- /form-group -->--}}
                        {{--</div><!-- /col-lg-6 -->--}}

                        {{--<div class="col-lg-6 pr-0">--}}
                            {{--<div class="form-group">--}}
                                {{--<label>Lucro máximo</label>--}}
                                {{--<input type="text" id="profitInput" class="form-control" disabled="disabled" placeholder="Lucro máximo" />--}}
                            {{--</div><!-- /form-group -->--}}
                        {{--</div><!-- /col-lg-6 -->--}}

                        <div class="form-group {{ $errors->has('description') ? 'has-error' : '' }}">
                            <label>Descrição</label>
                            <textarea name="description" class="form-control" placeholder="Descrição"></textarea>
                            <span class="help-block"><i class="icon-remove-sign"></i> {{ $errors->first('description') }}</span>
                        </div>

                        <button type="submit" class="btn btn-lg btn-success">Salvar</button>
                    </form>
                </div>
            </div><!-- /row -->
        </div><!-- /col-lg-12 -->
    </div><!-- /row -->
</div><!-- /content-wrapper -->

@endsection