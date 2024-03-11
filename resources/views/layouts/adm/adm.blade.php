<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Lotos Online - @yield('titlePage')</title>

    <link href="{{ asset('css/adm.css') }}" type="text/css" rel="stylesheet" />

    <!-- Favicon -->
    <link rel="icon" href="{{ asset('img/favicon.ico') }}" type="image/x-icon" />
    <link type="image/x-icon" href="{{ asset('img/favicon.ico') }}" rel="shortcut icon"/>

    <!--[if lt IE 9]>
    <script src="{{ asset('js/html5shiv.js') }}"></script>
    <script src="{{ asset('js/respond.min.js') }}"></script>
    <![endif]-->
</head>
    <body>

        @include('layouts.adm.includes.header')

        <div class="container">
            <div class="row">
                @include('layouts.adm.includes.sidebar')

                @yield('content')
            </div>
        </div>

        @include('layouts.adm.includes.footer')

        <script src="{{ asset('js/adm.js') }}?v=5"></script>

    </body>
</html>