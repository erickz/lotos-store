<div class="main-box clearfix">
    <div class="table-responsive">
        <table class="table customer-list">
            <thead>
            <tr>
                <th><span>Nome</span></th>
                <th class="text-center"><span>Verificado</span></th>
                <th><span>Jogos</span></th>
                <th><span>Criado</span></th>
                <th class="text-center"><span>Status</span></th>
                <th>&nbsp;</th>
            </tr>
            </thead>

            <tbody>
            @foreach ($boloes as $bolao)
            <tr>
                <td>
                    <a href="{{ route('adm.boloes.edit', [ $bolao->id ]) }}" class="user-link">
                        {{ $bolao->name }}
                    </a>
                </td>
                <td class="text-center">
                    <a href="{{ route('adm.boloes.edit', [ $bolao->id ]) }}" class="user-link">
                        {!! $bolao->getLabelChecked() !!}
                    </a>
                </td>
                <td>
                    <a href="{{ route('adm.boloes.edit', [ $bolao->id ]) }}" class="user-link">
                        {{ $bolao->getQtGames(true) }}
                    </a>
                </td>
                <td>
                    <a href="{{ route('adm.boloes.edit', [ $bolao->id ]) }}" class="user-link">
                        {{ $bolao->getCreatedAtFormatted() }}
                    </a>
                </td>
                <td class="text-center">
                    <a href="{{ route('adm.boloes.edit', [ $bolao->id ]) }}" class="user-link">
                        {!! $bolao->getLabelActive() !!}
                    </a>
                </td>
                <td style="width: 20%;">
                    <a href="{{ route('adm.boloes.edit', [$bolao->id]) }}" class="table-link">
                                                        <span class="fa-stack">
                                                            <i class="fa fa-square fa-stack-2x"></i>
                                                            <i class="fas fa-pen fa-stack-1x fa-inverse"></i>
                                                        </span>
                    </a>

                    <a href="{{ route('adm.boloes.destroy', [$bolao->id]) }}" class="table-link danger">
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
    {{ $boloes->links() }}
</div>