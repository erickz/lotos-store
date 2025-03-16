@extends('layouts.web.web')

@section('titlePage', 'Como Funciona - Jogos Online e Venda de Bolões')
@section('descriptionPage', 'Descubra como é simples e seguro participar dos jogos online e vender seus bolões conosco. ')

@section('content')

<!--begin::Entry-->
<!--begin::Entry-->
<div class="mt-5">
    <!--begin::Container-->
    <div class="p-5 container">
        <h1 class='ps-0 mb-0 text-secondary'><b>Blog da {{ env('APP_NAME') }}</b></h1>

        <div class='listingBlog w-100 mt-5 p-5 bg-white'>
            @foreach($blog as $post)
                <div class='postCt mb-5 border-bottom'>
                    <div class='col-md-9'>
                        <div class='titlePost'>
                            <a href='{{ route("web.blog.show", ["slug" => $post->slug]) }}' class='blog text-primary display-4'><b>{{ $post->title }}</b></a>
                        </div>
                        <div class='subtitlePost'>
                            <a href='{{ route("web.blog.show", ["slug" => $post->slug]) }}' class='blog text-secondary'>Criado em: {{ $post->getCreatedAtFormatted() }}</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div><!-- /w-100 -->
    </div><!--end::Container-->
</div><!--end::Entry-->

@endsection