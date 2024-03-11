@extends('layouts.web.web')

@section('titlePage', 'Como Funciona - Apostas Online e Venda de Bolões')
@section('descriptionPage', 'Descubra como é simples e seguro participar das apostas online e vender seus bolões conosco. 
Conheça todo o processo, desde a escolha dos números até a distribuição dos prêmios. proveite nossa plataforma intuitiva e 
comece a apostar ou vender seus bolões hoje mesmo!')

@section('content')

<!--begin::Entry-->
<!--begin::Entry-->
<div class="mt-5">
    <!--begin::Container-->
    <div class="p-5 container">
        <div class='mt-5 d-flex d-flex-responsive'>
            <div class='w-100 bg-white p-5 rounded'>
                <h1 class='ps-0 mb-0 text-secondary'><b>{{ $blog->title }}</b></h1>

                <div class='blogContent mt-4'>
                    {!! $blog->description !!}
                </div>
            </div>
            <div class='relatedPosts col min-w-200px ms-6'>
                @if($related)
                    <h2 class='ps-0'><b>Outros posts:</b></h2>

                    @foreach($related as $post)
                        <a href='{{ route("web.blog.show", ["slug" => $post->slug]) }}' class='blog text-primary d-block mb-6'><b><u>{{ $post->title }}</u></b></a>
                    @endforeach
                @endif
            </div>
        </div><!-- /w-100 -->

        @if($boloes && $boloes->count() > 0)
            <div class='mt-10'>
                <h2 class='ps-0'><b>Confira a lista de bolões para esse concurso!</b></h2>
                @include('web.boloes.listing_boloes', ['boloes' => $boloes])
            </div>
        @endif
    </div><!--end::Container-->
</div><!--end::Entry-->

@endsection