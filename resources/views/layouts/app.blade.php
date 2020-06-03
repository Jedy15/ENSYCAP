<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- CSRF Token -->
        <!-- <meta name="csrf-token" content="{{ csrf_token() }}"> -->

        <title>Ensycap</title>

        <link rel="icon" href="{{ asset('theme/img/icon.ico') }}" type="image/x-icon"/>

        <!-- Fonts and icons -->
        <script src="{{ asset('theme/js/plugin/webfont/webfont.min.js') }}"></script>
        <script>
            WebFont.load({
                google: {"families":["Lato:300,400,700,900"]},
                custom: {"families":["Flaticon", "Font Awesome 5 Solid", "Font Awesome 5 Regular", "Font Awesome 5 Brands", "simple-line-icons"], urls: ['{{ asset("theme/css/fonts.min.css") }}']},
                active: function() {
                    sessionStorage.fonts = true;
                }
            });
        </script>

        <!-- Styles -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">

        <!-- CSS Files -->
        <link rel="stylesheet" href="{{ asset('theme/css/atlantis.min.css') }}">
    </head>
    <body data-background-color="bg3">
        <div id="app">
            <app></app>
        </div>

        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}"></script>

        <!-- jQuery UI -->
        <script src="{{ asset('theme/js/plugin/jquery-ui-1.12.1.custom/jquery-ui.min.js') }}"></script>

        <!-- jQuery Scrollbar -->
        <script src="{!! asset('theme/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js') !!}"></script>

        <!-- Atlantis JS -->
        <script src="{!! asset('theme/js/atlantis.min.js') !!}"></script>
    </body>
</html>
