@extends('layouts.web.web')

@section('titlePage', 'Sobre a ' . env('APP_NAME') . ' | Segurança e transparência em Bolões Online')
@section('descriptionPage', 'Conheça nossa história e compromisso com apostas seguras. Equipe e tecnologia de ponta para você ganhar mais!')

@section('content')

<!--begin::Entry-->
<div class="mt-5">
    <!--begin::Container-->
    <div class="p-5 container">
        <h1 class='ps-0 mb-0 text-secondary'>Sobre nós</h1>

        <div class='row'>
            <div class='mt-5 bg-white p-5 col-md-12 rounded'>
                <p>
                    Bem-vindo ao {{ env('APP_NAME') }}! Somos uma equipe apaixonada por loterias e 
                    por oferecer uma experiência única aos amantes de jogos de todo o Brasil. 
                    Nossa missão é tornar a emoção das loterias mais acessível, social e lucrativa
                    através da <b>nossa plataforma inovadora</b>.
                </p>
                <p>
                    Desde a nossa fundação, nosso objetivo tem sido criar uma plataforma que ofereça mais 
                    do que apenas jogos de azar. Acreditamos que as loterias são uma maneira de unir pessoas 
                    e compartilhar o sucesso. É por isso que nos dedicamos a fornecer uma plataforma inovadora onde os 
                    jogadores podem criar e participar de bolões, aumentando suas chances de vitória a cada sorteio.
                </p>
                <p>
                    Nossa equipe é composta por entusiastas de jogos e tecnologia, trabalhando em conjunto para oferecer 
                    uma experiência segura, transparente e confiável para nossos jogadores. Valorizamos a integridade, a
                    responsabilidade e a diversão em tudo o que fazemos, desde a criação de bolões até a distribuição de 
                    prêmios.
                </p>
                <p>
                    Em caso de dúvidas ou sugestões <a href='{{ route("web.staticPages.contact") }}'>entre em contato</a>
                </p>
                <p>
                    <img src='{{ asset("img/icon-lotos-facil.png") }}' class='w-50px me-1' />
                    <b>Equipe {{ env('APP_NAME') }}</b>
                </p>
            </div>
        </div>
    </div><!--end::Container-->
</div><!--end::Entry-->

@endsection