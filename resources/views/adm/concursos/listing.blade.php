<div class="main-box clearfix">
    <div class="table-responsive">
        <table class="table customer-list">
            <thead>
                <tr>
                    <th><span>Loteria</span></th>
                    <th><span>Tem bolões</span></th>
                    <th><span>Verificado</span></th>
                    <th><span>Prêmiado</span></th>
                    <th><span>Remunerado</span></th>
                    <th><span>Número</span></th>
                    <th><span>Tipo</span></th>
                    <th><span>Data do sorteio</span></th>
                    <th>&nbsp;</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($concursos as $concurso)
                <tr>
                    <td>
                        <a href="{{ route('adm.concursos.edit', [ $concurso->id ]) }}" class="user-link">
                            {{ $concurso->lotery->name }}
                        </a>
                    </td>
                    <td>
                        <a href="{{ route('adm.concursos.edit', [ $concurso->id ]) }}" class="user-link">
                            @if ($concurso->checked)
                                <span class='badge badge-success badge-pill'>Sim</span>
                            @else
                                <span class='badge badge-danger badge-pill'>Não</span>
                            @endif
                        </a>
                    </td>
                    <td>
                        <a href="{{ route('adm.concursos.edit', [ $concurso->id ]) }}" class="user-link">
                            @if ($concurso->prized)
                                <span class='badge badge-success badge-pill'>Sim</span>
                            @else
                                <span class='badge badge-danger badge-pill'>Não</span>
                            @endif
                        </a>
                    </td>
                    <td>
                        <a href="{{ route('adm.concursos.edit', [ $concurso->id ]) }}" class="user-link">
                            @if ($concurso->revenued)
                                <span class='badge badge-success badge-pill'>Sim</span>
                            @else
                                <span class='badge badge-danger badge-pill'>Não</span>
                            @endif
                        </a>
                    </td>
                    <td>
                        <a href="{{ route('adm.concursos.edit', [ $concurso->id ]) }}" class="user-link">
                            @if ($concurso->boloes->count() > 0)
                                <span class='badge badge-success badge-pill'>Sim</span>
                            @else
                                <span class='badge badge-danger badge-pill'>Não</span>
                            @endif
                        </a>
                    </td>
                    <td>
                        <a href="{{ route('adm.concursos.edit', [ $concurso->id ]) }}" class="user-link">
                            {{ $concurso->number }}
                        </a>
                    </td>
                    <td>
                        <a href="{{ route('adm.concursos.edit', [ $concurso->id ]) }}" class="user-link">
                            {{ $concurso->getType() }}
                        </a>
                    </td>
                    <td>
                        <a href="{{ route('adm.concursos.edit', [ $concurso->id ]) }}" class="user-link">
                            {{ $concurso->getDrawDay() }}
                        </a>
                    </td>
                    <td style="width: 20%;">
                        <a href="{{ route('adm.concursos.edit', [$concurso->id]) }}" class="table-link">
                            <span class="fa-stack">
                                <i class="fa fa-square fa-stack-2x"></i>
                                <i class="fas fa-pen fa-stack-1x fa-inverse"></i>
                            </span>
                        </a>

                        <a href="{{ route('adm.concursos.destroy', [$concurso->id]) }}" class="table-link danger">
                            <span class="fa-stack">
                                <i class="fa fa-square fa-stack-2x"></i>
                                <i class="fas fa-trash fa-stack-1x fa-inverse"></i>
                            </span>
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    {{ $concursos->links() }}
</div>