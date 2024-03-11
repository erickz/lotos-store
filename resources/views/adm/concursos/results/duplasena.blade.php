<h2><span class="fas fa-list-alt"></span> Resultado</h2>

<div class="form-group {{ $errors->has('draw_numbers') ? 'has-error' : '' }}">
    <label>Números sorteados</label>
    <input class="form-control" type="text" name="draw_numbers" class="form-control" placeholder="Números sorteados" value="{{ $concurso->draw_numbers }}">
    <span class="help-block"><i class="icon-remove-sign"></i> {{ $errors->first('draw_numbers') }}</span>
</div>

<table class="table">
    <thead>
        <tr>
            <th>Faixa de Premiação</th>
            <th>Número de ganhadores</th>
            <th>Valor do Prêmio</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>
                <input class="form-control" type="text" name="results[0][prize_type]" readonly value="Sena" />
            </td>
            <td>
                <input class="form-control" type="text" name="results[0][number_winners]" value="{{ isset($concurso->results[0]->number_winners) ? $concurso->results[0]->number_winners : '' }}" />
            </td>
            <td>
                <div class="input-group">
                    <span class="input-group-addon">R$</span>
                    <input class="form-control maskMoney" type="text" name="results[0][value_prize]" value="{{ isset($concurso->results[0]->value_prize) ? $concurso->results[0]->value_prize : '' }}" />
                </div>
            </td>
        </tr>
        <tr>
            <td>
                <input class="form-control" type="text" name="results[1][prize_type]" readonly value="Quina" />
            </td>
            <td>
                <input class="form-control" type="text" name="results[1][number_winners]" value="{{ isset($concurso->results[1]->number_winners) ? $concurso->results[1]->number_winners : '' }}" />
            </td>
            <td>
                <div class="input-group">
                    <span class="input-group-addon">R$</span>
                    <input class="form-control maskMoney" type="text" name="results[1][value_prize]" value="{{ isset($concurso->results[1]->value_prize) ? $concurso->results[1]->value_prize : '' }}" />
                </div>
            </td>
        </tr>
        <tr>
            <td>
                <input class="form-control" type="text" name="results[2][prize_type]" readonly value="Quadra" />
            </td>
            <td>
                <input class="form-control" type="text" name="results[2][number_winners]" value="{{ isset($concurso->results[2]->number_winners) ? $concurso->results[2]->number_winners : '' }}" />
            </td>
            <td>
                <div class="input-group">
                    <span class="input-group-addon">R$</span>
                    <input class="form-control maskMoney" type="text" name="results[2][value_prize]" value="{{ isset($concurso->results[2]->value_prize) ? $concurso->results[2]->value_prize : '' }}" />
                </div>
            </td>
        </tr>
        <tr>
            <td>
                <input class="form-control" type="text" name="results[3][prize_type]" readonly value="Terno" />
            </td>
            <td>
                <input class="form-control" type="text" name="results[3][number_winners]" value="{{ isset($concurso->results[3]->number_winners) ? $concurso->results[3]->number_winners : '' }}" />
            </td>
            <td>
                <div class="input-group">
                    <span class="input-group-addon">R$</span>
                    <input class="form-control maskMoney" type="text" name="results[3][value_prize]" value="{{ isset($concurso->results[3]->value_prize) ? $concurso->results[3]->value_prize : '' }}" />
                </div>
            </td>
        </tr>
    </tbody>
</table>

<h2><span class="fas fa-list-alt"></span> Resultado 2</h2>

<div class="form-group {{ $errors->has('draw_numbers_2') ? 'has-error' : '' }}">
    <label>Números sorteados 2</label>
    <input class="form-control" type="text" name="draw_numbers_2" class="form-control" placeholder="Números sorteados" value="{{ $concurso->draw_numbers_2 }}">
    <span class="help-block"><i class="icon-remove-sign"></i> {{ $errors->first('draw_numbers_2') }}</span>
</div>

<table class="table">
    <thead>
        <tr>
            <th>Faixa de Premiação</th>
            <th>Número de ganhadores</th>
            <th>Valor do Prêmio</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>
                <input class="form-control" type="text" name="results_2[0][prize_type]" readonly value="Sena" />
            </td>
            <td>
                <input class="form-control" type="text" name="results_2[0][number_winners]" value="{{ isset($concurso->results_2[0]->number_winners) ? $concurso->results_2[0]->number_winners : '' }}" />
            </td>
            <td>
                <div class="input-group">
                    <span class="input-group-addon">R$</span>
                    <input class="form-control maskMoney" type="text" name="results_2[0][value_prize]" value="{{ isset($concurso->results_2[0]->value_prize) ? $concurso->results_2[0]->value_prize : '' }}" />
                </div>
            </td>
        </tr>
        <tr>
            <td>
                <input class="form-control" type="text" name="results_2[1][prize_type]" readonly value="Quina" />
            </td>
            <td>
                <input class="form-control" type="text" name="results_2[1][number_winners]" value="{{ isset($concurso->results_2[1]->number_winners) ? $concurso->results_2[1]->number_winners : '' }}" />
            </td>
            <td>
                <div class="input-group">
                    <span class="input-group-addon">R$</span>
                    <input class="form-control maskMoney" type="text" name="results_2[1][value_prize]" value="{{ isset($concurso->results_2[1]->value_prize) ? $concurso->results_2[1]->value_prize : '' }}" />
                </div>
            </td>
        </tr>
        <tr>
            <td>
                <input class="form-control" type="text" name="results_2[2][prize_type]" readonly value="Quadra" />
            </td>
            <td>
                <input class="form-control" type="text" name="results_2[2][number_winners]" value="{{ isset($concurso->results_2[2]->number_winners) ? $concurso->results_2[2]->number_winners : '' }}" />
            </td>
            <td>
                <div class="input-group">
                    <span class="input-group-addon">R$</span>
                    <input class="form-control maskMoney" type="text" name="results_2[2][value_prize]" value="{{ isset($concurso->results_2[2]->value_prize) ? $concurso->results_2[2]->value_prize : '' }}" />
                </div>
            </td>
        </tr>
        <tr>
            <td>
                <input class="form-control" type="text" name="results_2[3][prize_type]" readonly value="Terno" />
            </td>
            <td>
                <input class="form-control" type="text" name="results_2[3][number_winners]" value="{{ isset($concurso->results_2[3]->number_winners) ? $concurso->results_2[3]->number_winners : '' }}" />
            </td>
            <td>
                <div class="input-group">
                    <span class="input-group-addon">R$</span>
                    <input class="form-control maskMoney" type="text" name="results_2[3][value_prize]" value="{{ isset($concurso->results_2[3]->value_prize) ? $concurso->results_2[3]->value_prize : '' }}" />
                </div>
            </td>
        </tr>
    </tbody>
</table>