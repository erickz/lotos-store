@extends('layouts.web.web')

@section('titlePage', 'Últimos resultados da ' . $lotery->name)
@section('descriptionPage', 'Confirá o último resultado da ' . $lotery->name . '! Além de informações e estatísticas sobre a suas loterias favoritas')

@section('content')

<!--begin::Entry-->
<div class="d-flex flex-column-fluid mt-5">
    <!--begin::Container-->
    <div class="container">
        <div class="row boloesListing">
            <div class='col-lg-12'>
                <h1 class='ps-0 mb-0 text-secondary'><b>Últimos Resultados da {{ $lotery->name }}</b></h1>
                
                <div class='col-lg-12 ps-0 d-flex d-flex-responsive'>
                    <div class='col-md-9 ps-0'>
                        @foreach($concursos as $index => $concurso)
                            <div class='resultConcurso bg-light rounded border border-2 border-{{ $concurso->lotery->getColorClass() }} p-0 ms-0 mt-5 {{ $index%2==0 ? "me-10" : "" }} w-100 mb-5 position-relative'>
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
                                            <div class='number rounded-circle text-white me-5 bg-{{ $concurso->lotery->getColorClass() }}'><b>{{ $number }}</b></div>
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
                            </div><!-- /resultConcursos -->
                        @endforeach
                        @if($concursos->count() > 0)
                            {{ $concursos->withQueryString()->links('pagination::bootstrap-5') }}
                        @endif
                        <div class='loteryInfos mb-5'>
                            <div class='tab-content'>
                                <div class="accordion accordion-svg-toggle" id="faq">
                                    <div class="card">
                                        <div class="card-header" id="faqHeading1">
                                            <a class="card-title text-dark collapsed" data-toggle="collapse" href="#faq1" aria-expanded="false" aria-controls="faq1" role="button">
                                                <span class="svg-icon svg-icon-primary">
                                                    <!--begin::Svg Icon | path:assets/media/svg/icons/Navigation/Angle-double-right.svg-->
                                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                            <polygon points="0 0 24 0 24 24 0 24"></polygon>
                                                            <path d="M12.2928955,6.70710318 C11.9023712,6.31657888 11.9023712,5.68341391 12.2928955,5.29288961 C12.6834198,4.90236532 13.3165848,4.90236532 13.7071091,5.29288961 L19.7071091,11.2928896 C20.085688,11.6714686 20.0989336,12.281055 19.7371564,12.675721 L14.2371564,18.675721 C13.863964,19.08284 13.2313966,19.1103429 12.8242777,18.7371505 C12.4171587,18.3639581 12.3896557,17.7313908 12.7628481,17.3242718 L17.6158645,12.0300721 L12.2928955,6.70710318 Z" fill="#000000" fill-rule="nonzero"></path>
                                                            <path d="M3.70710678,15.7071068 C3.31658249,16.0976311 2.68341751,16.0976311 2.29289322,15.7071068 C1.90236893,15.3165825 1.90236893,14.6834175 2.29289322,14.2928932 L8.29289322,8.29289322 C8.67147216,7.91431428 9.28105859,7.90106866 9.67572463,8.26284586 L15.6757246,13.7628459 C16.0828436,14.1360383 16.1103465,14.7686056 15.7371541,15.1757246 C15.3639617,15.5828436 14.7313944,15.6103465 14.3242754,15.2371541 L9.03007575,10.3841378 L3.70710678,15.7071068 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" transform="translate(9.000003, 11.999999) rotate(-270.000000) translate(-9.000003, -11.999999)"></path>
                                                        </g>
                                                    </svg>
                                                    <!--end::Svg Icon-->
                                                </span>
                                                <div class="card-label text-dark pl-4">Saiba mais sobre a {{ $lotery->name }}</div>
                                            </a>
                                        </div>
                                        <div id="faq1" class="collapse" aria-labelledby="faqHeading1" data-parent="#faq" style="">
                                            <div class="card-body text-dark-50 font-size-lg pl-12">
                                                {!! $lotery->description !!}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card">
                                        <div class="card-header" id="faqHeading1">
                                            <a class="card-title text-dark collapsed" data-toggle="collapse" href="#faq2" aria-expanded="false" aria-controls="faq2" role="button">
                                                <span class="svg-icon svg-icon-primary">
                                                    <!--begin::Svg Icon | path:assets/media/svg/icons/Navigation/Angle-double-right.svg-->
                                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                            <polygon points="0 0 24 0 24 24 0 24"></polygon>
                                                            <path d="M12.2928955,6.70710318 C11.9023712,6.31657888 11.9023712,5.68341391 12.2928955,5.29288961 C12.6834198,4.90236532 13.3165848,4.90236532 13.7071091,5.29288961 L19.7071091,11.2928896 C20.085688,11.6714686 20.0989336,12.281055 19.7371564,12.675721 L14.2371564,18.675721 C13.863964,19.08284 13.2313966,19.1103429 12.8242777,18.7371505 C12.4171587,18.3639581 12.3896557,17.7313908 12.7628481,17.3242718 L17.6158645,12.0300721 L12.2928955,6.70710318 Z" fill="#000000" fill-rule="nonzero"></path>
                                                            <path d="M3.70710678,15.7071068 C3.31658249,16.0976311 2.68341751,16.0976311 2.29289322,15.7071068 C1.90236893,15.3165825 1.90236893,14.6834175 2.29289322,14.2928932 L8.29289322,8.29289322 C8.67147216,7.91431428 9.28105859,7.90106866 9.67572463,8.26284586 L15.6757246,13.7628459 C16.0828436,14.1360383 16.1103465,14.7686056 15.7371541,15.1757246 C15.3639617,15.5828436 14.7313944,15.6103465 14.3242754,15.2371541 L9.03007575,10.3841378 L3.70710678,15.7071068 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" transform="translate(9.000003, 11.999999) rotate(-270.000000) translate(-9.000003, -11.999999)"></path>
                                                        </g>
                                                    </svg>
                                                    <!--end::Svg Icon-->
                                                </span>
                                                <div class="card-label text-dark pl-4">Estatísticas de ganhar na {{ $lotery->name }}</div>
                                            </a>
                                        </div>
                                        <div id="faq2" class="collapse" aria-labelledby="faqHeading1" data-parent="#faq" style="">
                                            <div class="card-body text-dark-50 font-size-lg pl-12">
                                                {!! $lotery->description_stats !!}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class=''>
                        @foreach($loteries as $loto)
                            <h2 class='p-0 m-4 mb-8'><a href='{{ route("web.results.byLotery", [$loto->getSlug()]) }}' class='d-block text-secondary2 mt-2 mb-2'><b>Confira o último resultado da <span class='text-{{ $loto->getColorClass() }}'>{{ $loto->name }}</span></b></a></h2>
                        @endforeach
                    </div>
                </div><!-- /col-lg-12 -->

                @include('web.boxes_to_action')
            </div><!-- /col-lg-12 -->
        </div><!-- /boloesListing -->
    </div><!--end::Container-->
</div><!--end::Entry-->

@endsection