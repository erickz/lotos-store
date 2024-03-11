<div class="main-box clearfix">
    <div class="table-responsive">
        <table class="table customer-list">
            <thead>
            <tr>
                <th style="width: 100px;"><span>Sigla</span></th>
                <th><span>Nome</span></th>
                <th><span>Dias de sorteio</span></th>
                <th>&nbsp;</th>
            </tr>
            </thead>

            <tbody>
                @foreach ($loteries as $lotery)
                <tr>
                    <td>
                        <a href="{{ route('adm.loteries.show', [ $lotery->id ]) }}" class="user-link">
                            {{ $lotery->initials }}
                        </a>
                    </td>
                    <td>
                        <a href="{{ route('adm.loteries.show', [ $lotery->id ]) }}" class="user-link">
                            {{ $lotery->name }}
                        </a>
                    </td>
                    <td>
                        <a href="{{ route('adm.loteries.show', [ $lotery->id ]) }}" class="user-link">
                            {{ $lotery->getFormatedDrawDays() }}
                        </a>
                    </td>
                    <td style="width: 20%;">
                        <a href="{{ route('adm.loteries.show', [$lotery->id]) }}" class="table-link">
                            <span class="fa-stack">
                                <i class="fa fa-square fa-stack-2x"></i>
                                <i class="fas fa-search fa-stack-1x fa-inverse"></i>
                            </span>
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    {{ $loteries->links() }}
</div>