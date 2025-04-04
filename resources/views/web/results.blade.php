@extends('layouts.web.web')

@section('titlePage', 'Ultimos resultados das suas loterias favoritas')
@section('descriptionPage', 'Acesse nossa página e confirá os últimos resultados da Mega Sena, Lotofacil, Quina e Dupla Sena')

@section('content')

<!--begin::Entry-->
<div class="d-flex flex-column-fluid mt-5">
    <!--begin::Container-->
    <div class="container">
        <div class="row boloesListing">
            <div class='col-lg-12'>
                <div class=''>
                    <h1 class='ps-0 mb-0 text-secondary'><b>Últimos Resultados das Loterias Online</b></h1>
                    <?php 
                    $pairCounting = 1;
                    ?>
                    @foreach($concursos as $index => $concurso)
                        @if ($pairCounting == 1)
                            <div class='d-flex d-flex-responsive'>
                        @endif
                        <div class='resultConcurso col rounded border border-2 border-{{ $concurso->lotery->getColorClass() }} p-0 ms-0 me-2 mt-5 mb-10 position-relative h-100 bg-light'>
                            <div class='resultHeader d-flex align-items-center justify-content-between border-bottom border-{{ $concurso->lotery->getColorClass() }}'>
                                <div class='titleHolder mt-4 mb-4 w-25'>
                                    <h2 class='p-0 ps-5 text-{{ $concurso->lotery->getColorClass() }}'><b>{{ $concurso->lotery->name }}</b></h2¿>
                                </div>
                                <div class='concursoNumber text-center w-50'>
                                    <span class='text-{{ $concurso->lotery->getColorClass() }}'>Concurso</span> <br />
                                    <b>{{ $concurso->number }}</b>
                                </div>
                                <div class='concursoDate text-center w-25'>
                                    <span class='text-{{ $concurso->lotery->getColorClass() }}'>Data do Sorteio</span> <br />
                                    <b>{{ $concurso->getDrawDay() }}</b>
                                </div>
                            </div>
                            <div class='d-flex flex-column align-items-center'>
                                <div class='listNumbers d-flex w-100 justify-content-center {{ $concurso->type == 3 ? "mt-6 mb-6" : "mt-15 mb-10 biggerResults" }}'>
                                    @foreach($concurso->getArDrawNumbers() as $number)
                                        <div class='number display-4 rounded-circle text-white me-5 bg-{{ $concurso->lotery->getColorClass() }}'><b>{{ $number }}</b></div>
                                    @endforeach
                                </div>
                                @if ($concurso->type == 3)
                                    <div class='text-center mx-auto border-top'>
                                        <b class='text-{{ $concurso->lotery->getColorClass() }} p-2 font-bigger'>ACUMULOU!</b>
                                    </div>
                                @endif
                                <div class='concursoResults mt-5 w-100'>
                                    @foreach ($concurso->results as $index => $result)
                                        <div class='d-flex pb-1 pt-1 justify-content-between text-center {{ ($index) == (count($concurso->results)-1) ? "" : "border-bottom border-" . $concurso->lotery->getColorClass() }}'>
                                            <div class='w-25'><b>{{ $result->prize_type }}</b></div>
                                            <div class='w-50'><b>{{ number_format($result->number_winners, 0, '.', '.') }} ganhadores</b></div>
                                            <div class='w-25'><b>R${{ number_format(floatval(str_replace(',', '.',str_replace('.', '', $result->value_prize))), 2, ',', '.') }}</b></div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            <div class='mt-4 mb-2 me-2 d-flex flex-row-reverse'>
                                <a href='{{ route("web.results.byLotery", [$concurso->lotery->getSlug()]) }}' class='btn btn-{{ $concurso->lotery->getColorClass() }}'><b>Saiba mais</b></a>
                            </div>
                        </div><!-- /resultConcursos -->
                        @if ($pairCounting++ == 2)
                            </div>

                            <?php 
                                $pairCounting = 1;
                            ?>
                        @endif
                    @endforeach
                </div>
                @if($concursos->count() > 0)
                    {{ $concursos->withQueryString()->links('pagination::bootstrap-5') }}
                @endif
            </div><!-- /col-lg-12 -->

        </div><!-- /boloesListing -->
    </div><!--end::Container-->
</div><!--end::Entry-->

@endsection