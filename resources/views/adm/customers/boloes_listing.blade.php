<div class="clearfix">
    <div class="table-responsive">
        <table class="table customer-list">
            <thead>
            <tr>
                <th><span>Id</span></th>
                <th><span>Nome</span></th>
                <th><span>Quantidade de compradores</span></th>
                <th><span>Concurso</span></th>
                <th><span>Data de criação</span></th>
                <th>&nbsp;</th>
            </tr>
            </thead>

            <tbody>
            @foreach ($customer->boloes as $bolao)
                <tr>
                    <td>
                        <a href="{{ route('adm.boloes.edit', [ $bolao->id ]) }}" class="user-link">
                            {{ $bolao->id }}
                        </a>
                    </td>
                    <td>
                        <a href="{{ route('adm.boloes.edit', [ $bolao->id ]) }}" class="user-link">
                            {{ $bolao->name }}
                        </a>
                    </td>
                    <td>
                        <a href="{{ route('adm.boloes.edit', [ $bolao->id ]) }}" class="user-link">
                            {{ $bolao->buyers->count() }}
                        </a>
                    </td>
                    <td>
                        <a href="{{ route('adm.concursos.edit', [ $bolao->concurso_id ]) }}" class="user-link">
                            {{ $bolao->lotery->name }} - Nº {{ $bolao->concurso->number }}
                        </a>
                    </td>
                    <td>
                        <a href="{{ route('adm.boloes.edit', [ $bolao->id ]) }}" class="user-link">
                            {{ $bolao->getCreatedAtFormatted() }}
                        </a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div><!-- /main-box -->