@extends('layouts.web.web')

@section('titlePage', 'Em breve')

@section('content')

    <div id="logo-lotos-online" class="justify-content-center">
        <img src="{{ asset('img/lotos-online-logo-v7.png') }}" alt="Logo Lotos Online" title="Lotos Online" />
    </div><!-- /logo-lotos-online -->

    <div class="mt-5 text-center" style="color: #333; font-family: 'Open Sans'">
        <h3><b>A Lotos Online é uma plataforma de vendas de bolões das loterias federais</b></h3>

        <h5 class="mt-5" style="width: 65%; text-align: justify; margin: 0 auto;">
            <label style="text-decoration: underline; margin-bottom: 0;">Atualmente em desenvolvimento</label>, a plataforma conta com diversas soluções visando auxiliar a venda de bolões online. O sistema conta com:
            sistema de cadastro e importação de bolões, checagem automática de resultados, sistema de pagamentos e <b>muitas outras features.</b>
        </h5>
    </div>

    <div class="mt-5 mb-10 text-center" style="color: #333; font-family: 'Open Sans';">
        <bold>Contato:</bold> <a href="mailto:coxntato@lotosonlinex.com.br" style="color: #333; text-decoration: underline; unicode-bidi: bidi-override; direction: rtl;" onmouseover="this.href=this.href.replace(/x/g,'');">rb.moc.enilnosotol@otatnoc</a>
    </div>

{{--    <div class="w-300px m-auto">--}}
{{--        <div class="card card-custom">--}}
{{--            <div class="card-header">--}}
{{--                <div class="card-title">--}}
{{--                    <span class="card-icon">--}}
{{--                        <i class="fa fa-newspaper"></i>--}}
{{--                    </span>--}}
{{--                    <h2 class="card-label">Assine o newsletter</h2>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <div class="card-body">--}}
{{--                <form action="{{ route('web.newsletter.store') }}" action="POST" role="form" class="form">--}}
{{--                    @include('web.includes.alert')--}}
{{--                    @csrf--}}
{{--                    <div class="form-group">--}}
{{--                        <input type="text" class="form-control" placeholder="Digite seu email:">--}}
{{--                    </div>--}}
{{--                    <div class="form-group text-center">--}}
{{--                        <button type="submit" class="btn btn-lg btn-success">Inscreva-se!</button>--}}
{{--                    </div>--}}
{{--                </form>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}

@endsection
