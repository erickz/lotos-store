{{-- <div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
    <div class="container d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
        <!--begin::Info-->
        <div id='nextContestsBar' class="d-flex align-items-center flex-wrap mr-2">
            <!--begin::Actions-->
            <span class="text-muted font-weight-bold me-2"><b>Próximos sorteios:</b></span>
            @foreach($allFollowingConcursos as $concurso)
                <a href="#" class="btn btn-light-{{ $concurso->lotery->getColorClass() }} font-weight-bolder btn-sm me-2"><b>{{ $concurso->lotery->name }}</b> <br /> <b>{{ $concurso->getDrawDay() }}</b> - Nº {{ $concurso->number }} </a>
            @endforeach
            <!--end::Actions-->
        </div><!--end::Info-->
    </div>
</div> --}}