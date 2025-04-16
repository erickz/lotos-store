<!DOCTYPE html>
<html>
    <head>
        <!-- Google tag (gtag.js) -->
        <script async src="https://www.googletagmanager.com/gtag/js?id=G-XW0KKVZNXN"></script>
        <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'G-XW0KKVZNXN');
        gtag('config', 'AW-1006379501');
        </script>

        <!-- Hotjar Tracking Code for https://www.lotosonline.com.br -->
            <script>
            (function(h,o,t,j,a,r){
                h.hj=h.hj||function(){(h.hj.q=h.hj.q||[]).push(arguments)};
                h._hjSettings={hjid:3677876,hjsv:6};
                a=o.getElementsByTagName('head')[0];
                r=o.createElement('script');r.async=1;
                r.src=t+h._hjSettings.hjid+j+h._hjSettings.hjsv;
                a.appendChild(r);
            })(window,document,'https://static.hotjar.com/c/hotjar-','.js?sv=');
        </script>

        <meta charset="UTF-8" />
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>{{ request()->routeIs('web.home') ? '' : env('APP_NAME') . ' |' }} @yield('titlePage')</title>
        <meta name="description" content="@yield('descriptionPage', 'Nunca foi tão lucrativo apostar nas loterias online! Aposte de casa nas loterias mais populares do Brasil e venha vender seus bolões online!')">

        <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&display=swap" rel="stylesheet">
        <link href="{{ asset('css/web.css') }}" type="text/css" rel="stylesheet" />

        <!-- Favicon -->
        <link rel="icon" href="{{ asset('img/favicon.ico') }}" type="image/x-icon" />
        <link type="image/x-icon" href="{{ asset('img/favicon.ico') }}?v=2" rel="shortcut icon"/>
        <!-- {!! RecaptchaV3::initJs() !!} -->

        <!--[if lt IE 9]>
            <script src="{{ asset('js/html5shiv.js') }}"></script>
            <script src="{{ asset('js/respond.min.js') }}"></script>
        <![endif]-->

        @stack('styles')

        @include('facebook-pixel::head')
    </head>
    <body id="kt_body" class="quick-panel-right offcanvas-right header-fixed subheader-enabled">        
        @include('facebook-pixel::body')

        @if(! isset($disableMenu) || $disableMenu = FALSE)
            <div class='menu-mobile'>
                <div class='p-5 pb-0'>
                    <div class='menuMobileTriggerHolder cursor-pointer pb-3'>
                        <a class='menuMobileTrigger' data-event='close'><i class='fa fa-times me-4 text-primary'></i>Fechar</a>
                    </div>
                </div>

                <div class='border border-bottom border-secondary2'>
                    @include('layouts.web.menu')
                </div>

                <div class='additonalMobileMenu p-5'>
                    @if(! Auth::guard('web')->check())
                        <div class="d-flex flex-column">
                            <button type="button" class="btn btn-success mb-3" data-toggle="modal" data-target="#loginModal">
                                <b>Login</b>
                            </button>

                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#registerModal">
                                <b>Cadastre-se!</b>
                            </button>
                        </div>
                    @else
                        <div class="topbar-item me-5 responsive-item">
                            <ul>
                                <li class='mt-2'><a class='p-0' href='{{ route("web.cart") }}' class='text-primary'><i class='fa fa-user me-3 text-primary'></i>Seu saldo: <label class='bg-success p-2 badge'><b>{{ auth()->guard('web')->user()->getFormattedCredits() }}</b></label></a></li>
                                <li class='mt-2'><a class='p-0' href='{{ route("web.cart") }}' class='text-primary'><i class='fa fa-shopping-cart me-2 text-primary'></i>Carrinho</a></li>
                                <li class='mt-2'><a class='p-0' href='{{ route("web.customers.logout") }}' class='text-primary'><i class='fa fa-sign-out-alt me-3 text-primary'></i>Sair</a></li>
                            </ul>
                        </div>
                    @endif
                </div>
            </div>
            <div id="kt_header_mobile" class="header-mobile px-3">
                <div class='d-flex mt-3 justify-content-between align-items-center w-100'>
                    <a class='fa fa-bars menuMobileTrigger'></a>
                    <!--begin::Logo-->
                    <a href="/" class='ms-9 d-flex flex-column align-self-center'>
                        <img alt="Logo LotosFácil" title="LotosFácil" src="{{ asset('img/logo-lotos-online.png') }}" class="max-h-60px">
                    </a>
                    <!--end::Logo-->
                    @include('layouts.web.header-toolbar')
                </div>
            </div>
        @endif

        <div class="d-flex flex-column flex-root">
            <!--begin::Page-->
            <div class="d-flex flex-row flex-column-fluid page">
                <!--begin::Wrapper-->
                <div class="d-flex flex-column flex-row-fluid wrapper" id="kt_wrapper">

                    @if(! isset($disableMenu) || $disableMenu = FALSE)
                        <!--begin::Header-->
                        @include('layouts.web.header-top')
                        <!--end::Header-->
                    @endif

                    <!--begin::Content-->
                    <div class="content d-flex flex-column flex-column-fluid pb-0" id="kt_content">

                        @if(! isset($disableMenu) || $disableMenu = FALSE)
                            @if (! in_array(Route::currentRouteName(), ['web.home.index']))
                                <!--begin::Subheader-->
                                @include('layouts.web.header-bottom')
                                <!--end::Subheader-->
                            @endif
                        @endif
                            
                        @include('web.customers.register_modal')
                        @include('web.customers.login_modal')

                        @include('web.boloes.buy_confirmation_modal')

                        @yield('content')
                    </div>
                    <!--end::Content-->
                </div>
                <!--end::Wrapper-->
            </div>
            <!--end::Page-->
        </div>

        <!--begin::Footer-->
        @include('layouts.web.footer')
        <!--end::Footer-->

        <script src="{{ asset('js/web.js') }}"></script>

        @stack('scripts')
    </body>
</html>
