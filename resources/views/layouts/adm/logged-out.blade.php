<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>SuperheroAdmin - @yield('titlePage')</title>

        <link href="{{ asset('css/logged-out.css') }}" type="text/css" rel="stylesheet" />

        <!-- Favicon -->
        <link type="image/x-icon" href="{{ asset('favicon.png') }}" rel="shortcut icon"/>

        <!--[if lt IE 9]>
        <script src="{{ asset('js/html5shiv.js') }}"></script>
        <script src="{{ asset('js/respond.min.js') }}"></script>
        <![endif]-->
    </head>
    <body id="login-page">
        <div class="container">
            <div class="row">

                @yield('content')
            </div>
        </div>

        <script src="{{ asset('js/essentials.js') }}"></script>
    </body>
</html>