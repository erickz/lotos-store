<div class='b-table'>
    <div class='bg-white p-2 rounded bolaoTable table-responsive-lg table-wrapper has-mobile-cards'>
        <table class='table is-fullwidth is-striped is-hoverable is-fullwidth table-white text-center'>
            <thead>
                <tr>
                    <td class='p-3'>Loteria</td>
                    <td class='p-3'></td>
                    <td class='p-3'>Concurso</td>
                    <td class='p-3'>Prêmio estimado</td>
                    <td class='p-3'></td>
                    <td class='p-3'>Cotas</td>
                    <td class='p-3'>Preço</td>
                    <td class='p-3'></td>
                    <td class='p-3'></td>
                </tr>
            </thead>
            <tbody>
                @if($boloes->count() > 0)
                    @foreach($boloes as $bolao)
                        <tr>
                            <td data-label='Loteria' class='p-4 align-items-center'>
                                {!! $bolao->lotery->getLabelName() !!}
                            </td>
                            <td data-label='Chances' class='p-4'><b>{!! $bolao->getLblChances(true) !!}</b></td>
                            <td data-label='Concurso' class='p-4'>
                                <b>Nº {{ $bolao->concurso->number }} -
                                {{ $bolao->concurso->getDrawDay() }}</b>
                            </td>
                            <td data-label='Prêmio Estimado' class='p-4 text-primary estimatedPrize'>
                                <strong>{!! $bolao->concurso->getNextExpectedPrize() !!}</strong>
                            </td>
                            <td data-label='Visualizar jogos' class='p-4'>
                                <a class='gamesTrigger bolao_{{ $bolao->id }}' data-toggle="modal" data-target="#bolaoInfosModal" data-id='{{ $bolao->id }}' data-gamesurl='{{ route("web.boloes.games", [$bolao->id]) }}'>
                                    <i class="fas fa-search text-light rounded bg-info p-2" title='Visualizar Jogos' role='button'></i>
                                </a>
                            </td>
                            <td data-label='Cotas' class='p-4 cotasDisplay'>{{ $bolao->getAvailableCotas() }} / {{ $bolao->cotas }}</td>
                            <td data-label='Preço' class='p-4'>{{ $bolao->getFormattedPrice() }}</td>
                            <td align='right' class='p-4'>
                                <div class='slHolder'>
                                    <select name='cotas' class='form-control isFromTable slChooseCotas resetSelect'>
                                        @for($i = 0; $i <= $bolao->getAvailableCotas(); $i++)
                                            <option value='{{ $i }}'>{{ $i }}</option>
                                        @endfor
                                    </select>
                                </div>
                            </td>
                            <td align='left' class='p-4'>
                                <a class='cursor-p btn btn-success btn-sm text-center btnBuyCota isFromTable disabled' data-toggle="modal" data-target="#buyConfirmationModal" data-gamesurl='{{ route("web.boloes.buy", [$bolao->id]) }}'><i class='fa fa-shopping-cart'></i></a>
                            </td>
                        </tr>
                    @endforeach
                @endif
            </tbody>
        </table>

        <div class='mt-2 ps-2 me-12 text-end'>
            @if(isset($displayPagination) && $displayPagination)
                @if($boloes->count() > 0)
                    {{ $boloes->withQueryString()->links('pagination::bootstrap-5') }}
                @endif
            @else
                <a href="{{ route('web.boloes.create') }}" class="ms-auto me-2 btn btn-success"><strong>+ Criar Bolão</strong></a>

                @if (! request()->routeIs('web.boloes.listing_all'))
                    <a href='{{ route("web.boloes.listing_all") }}' class='btn btn-primary'><b>Ver todos</b></a>
                @endif
            @endif
        </div>
    </div>
</div>