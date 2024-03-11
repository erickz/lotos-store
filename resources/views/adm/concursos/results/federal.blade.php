<h2><span class="fas fa-list-alt"></span> Resultado</h2>

<div class="form-group {{ $errors->has('draw_numbers') ? 'has-error' : '' }}">
    <label>Números sorteados</label>
    <input class="form-control" type="text" name="draw_numbers" class="form-control" placeholder="Números sorteados" value="{{ $concurso->draw_numbers }}">
    <span class="help-block"><i class="icon-remove-sign"></i> {{ $errors->first('draw_numbers') }}</span>
</div>