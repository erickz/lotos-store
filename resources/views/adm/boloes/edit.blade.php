@extends('layouts.adm.adm')

@section('titlePage', 'Boloes - Editar')

@section('content')

<div class="col-md-10" id="content-wrapper">
    <div class="row">
        <div class="col-lg-12">

            <div class="clearfix">
                <h1 class="pull-left"><span class="fas fa-newspaper"></span> Editar boloes</h1>
            </div>

            @include('adm.elements.alert')

            <div class="row">
                <div class="main-box col-md-12">
                    <form method="post" role="form" action="{{ route('adm.boloes.update', [$bolao->id]) }}">
                        @csrf
                        @method('patch')

                        <div class="form-group">
                            <div class="onoffswitch onoffswitch-success">
                                <input type="checkbox" name="active" value="1" class="onoffswitch-checkbox" id="myonoffswitch3" {{ $bolao->active ? "checked='checked'" : '' }}>
                                <label class="onoffswitch-label" for="myonoffswitch3">
                                    <div class="onoffswitch-inner"></div>
                                    <div class="onoffswitch-switch"></div>
                                </label>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="onoffswitch featuredSwitch onoffswitch-success">
                                <input type="checkbox" name="featured" value="1" class="onoffswitch-checkbox" id="myonoffswitch" {{ $bolao->featured ? "checked='checked'" : '' }}>
                                <label class="onoffswitch-label" for="myonoffswitch">
                                    <div class="onoffswitch-inner"></div>
                                    <div class="onoffswitch-switch"></div>
                                </label>
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Criador do bolão</label>
                            <div>
                                @if ($bolao->customer_id)
                                    <a href='{{ route("adm.customers.edit", [$bolao->customer_id]) }}'><strong>{{ $bolao->customer->full_name }}</strong></a>
                                @else
                                    <strong>Administrador</strong>
                                @endif
                            </div>
                        </div>

                        <div class="form-group {{ $errors->has('concurso_id') ? 'has-error' : '' }}">
                            <label>Concurso</label>
                            <select class="form-control select2" name="concurso_id" {{ $bolao->checked ? 'disabled="disabled"' : '' }}>
                                <option value="" {{ $bolao->concurso_id == '' ? 'selected="selected"' : '' }}>Selecione a concurso</option>

                                @foreach($concursosList as $lotery => $concursos)
                                    <optgroup label="{{ ucwords(str_replace('-', ' ', $lotery)) }}">
                                        @foreach($concursos as $concurso)
                                            <?php
                                            var_dump($bolao->concurso_id == $concurso->id);
                                            ?>
                                            <option value="{{ $concurso->id }}" {{ $bolao->concurso_id == $concurso->id ? 'selected="selected"' : '' }}>#{{ $concurso->number }} - {{ $concurso->getDrawDay() }}</option>
                                        @endforeach
                                    </optgroup>
                                @endforeach
                            </select>
                            <span class="help-block"><i class="icon-remove-sign"></i> {{ $errors->first('concurso_id') }}</span>
                        </div>

                        <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                            <label>Nome do bolão</label>
                            <input type="text" name="name" class="form-control" placeholder="Nome" value="{{ $bolao->name }}">
                            <span class="help-block"><i class="icon-remove-sign"></i> {{ $errors->first('name') }}</span>
                        </div>

                        <div class="col-lg-6 pl-0">
                            <div class="form-group {{ $errors->has('cotas') ? 'has-error' : '' }}">
                                <label>Cotas</label>
                                <input type="number" name="cotas" id="cotaInput" class="form-control" placeholder="Número" value="{{ $bolao->cotas ? $bolao->cotas : '1' }}">
                                <span class="help-block"><i class="icon-remove-sign"></i> {{ $errors->first('cotas') }}</span>
                            </div>
                        </div><!-- /col-lg-6 -->

                        <div class="col-lg-6">
                            <div class="form-group {{ $errors->has('cotas_available') ? 'has-error' : '' }}">
                                <label>Cotas disponíveis</label>
                                <input type="number" name="cotas_available" class="form-control" placeholder="Número" value="{{ $bolao->cotas_available ? $bolao->cotas_available : '1' }}">
                                <span class="help-block"><i class="icon-remove-sign"></i> {{ $errors->first('cotas_available') }}</span>
                            </div>
                        </div><!-- /col-lg-6 -->

                        <div class="form-group {{ $errors->has('price') ? 'has-error' : '' }}">
                            <label>Preço da cota</label>
                            <div class="input-group">
                                <span class="input-group-addon">R$</span>
                                <input type="text" name="price" id='cotaPriceInput' class="form-control maskMoney" placeholder="Preço da cota" value="{{ $bolao->price }}">
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
                            <textarea name="description" class="form-control" placeholder="Descrição">{{ $bolao->description }}</textarea>
                            <span class="help-block"><i class="icon-remove-sign"></i> {{ $errors->first('description') }}</span>
                        </div>

                        <button type="submit" class="btn btn-lg btn-success">Save</button>
                    </form>
                </div>

                {{--<div class="col-md-6">--}}
                    {{--<div class="bolaoBuilder">--}}
                        {{--<div class="numberPicker">--}}
                            {{--@for($i = 1; $i <= $bolao->lotery->biggest_number; $i++)--}}
                                {{--<span class="number" data-number="{{ $i }}">{{ $i < 10 ? 0 . $i : $i }}</span>--}}
                            {{--@endfor--}}
                        {{--</div><!-- /bolaoBuilder -->--}}

                        {{--<div class="chosenNumbersCt mt-3">--}}
                            {{--<strong>Números selecionados:</strong> <br />--}}
                            {{--<div class="chosenNumbers">--}}

                            {{--</div><!-- /chosenNumbers -->--}}
                        {{--</div><!-- / -->--}}

                        {{--<div class="clearfix mt-3">--}}
                            {{--<div class="pull-left mt-0">--}}
                                {{--<a class="btn btn-primary addBolao pull-left">--}}
                                    {{--<i class="fas fa-plus-circle fa-lg"></i> Adicionar jogo--}}
                                {{--</a>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                {{--</div>--}}
            </div><!-- /row -->

            @include('adm.boloes.gamesBuilder')
        </div>
    </div>
</div>

@endsection