<!DOCTYPE html>
<html>
    <head>
        <!-- Global site tag (gtag.js) - Google Analytics -->
        <script async src="https://www.googletagmanager.com/gtag/js?id=UA-30506614-1"></script>
        <script>
            window.dataLayer = window.dataLayer || [];
            function gtag(){dataLayer.push(arguments);}
            gtag('js', new Date());

            gtag('config', 'UA-30506614-1');
        </script>

        <!-- Hotjar Tracking Code for https://www.lotosfacil.com.br -->
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

        <title>Lotos Online - @yield('titlePage')</title>
        <meta name="description" content="@yield('descriptionPage', 'Venda seus bolões online com a plataforma Lotos Online')">

        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700">
        <link href="{{ asset('css/web.css') }}?v=6" type="text/css" rel="stylesheet" />

        <!-- Favicon -->
        <link rel="icon" href="{{ asset('img/favicon.ico') }}" type="image/x-icon" />
        <link type="image/x-icon" href="{{ asset('img/favicon.ico') }}" rel="shortcut icon"/>

        <!--[if lt IE 9]>
            <script src="{{ asset('js/html5shiv.js') }}"></script>
            <script src="{{ asset('js/respond.min.js') }}"></script>
        <![endif]-->

        @stack('styles')

        <!-- Meta Pixel Code -->
        <script>
        !function(f,b,e,v,n,t,s)
        {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
        n.callMethod.apply(n,arguments):n.queue.push(arguments)};
        if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
        n.queue=[];t=b.createElement(e);t.async=!0;
        t.src=v;s=b.getElementsByTagName(e)[0];
        s.parentNode.insertBefore(t,s)}(window, document,'script',
        'https://connect.facebook.net/en_US/fbevents.js');
        fbq('init', '306615862098235');
        fbq('track', 'PageView');
        </script>
        <noscript><img height="1" width="1" style="display:none"
        src="https://www.facebook.com/tr?id=306615862098235&ev=PageView&noscript=1"
        /></noscript>
        <!-- End Meta Pixel Code -->

        @include('facebook-pixel::head')
    </head>
    <body class="quick-panel-right demo-panel-right offcanvas-right header-fixed subheader-fixed subheader-enabled">
        @include('facebook-pixel::body')

        <div id="contentHolder">

            <div class='bg-info3 border border-top-0 border-left-0 border-right-0 border-bottom border-secondary'>
                <div id='headerCheckout' class='w-checkout col-md-12 pt-2'>
                    <!--begin::Header Logo-->
                    <div class="header-logo d-flex">
                        <a href="{{ route('web.home') }}" class='text-left mt-1'>
                            <img alt="Logo {{ env('APP_NAME') }}" title="{{ env('APP_NAME') }}" src="{{ asset('img/logo-lotos-facil-white.png') }}" class="max-h-60px">
                        </a>
                        
                        <div class='ms-auto mt-2'>
                            <img class='securitySeal max-h-50px' alt="Compra 100% segura" title="Compra 100% segura" src="{{ asset('img/security-seal-checkout-v2.png') }}">
                        </div>
                    </div>
                </div>
            </div><!-- /bg-info -->

            <!--begin::Content-->
            <div id="kt_content" class="content w-checkout mt-5 pt-0 min-h-450px">
                @yield('content')
            </div><!--end::Content-->

            <div class='footer mt-5 p-5 text-center h-150px bg-info3'>
                <div class='d-flex justify-content-center mt-7'>
                    <h3 class='text-white'>Lotos Fácil</h3>
                    <div class='ms-3 text-white mt-1'>- www.lotosfacil.com.br</div>
                </div>
                <img class='securitySeal  max-h-50px' alt="Compra 100% segura" title="Compra 100% segura" src="{{ asset('img/security-seal-checkout-v2.png') }}">
            </div>
        </div><!-- contentHolder -->

        <script src="{{ asset('js/web.js') }}"></script>
        <script src="{{ asset('js/checkout.js') }}?v=2"></script>

        @stack('scripts')
    </body>
</html>
