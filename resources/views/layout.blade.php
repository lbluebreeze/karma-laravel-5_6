<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Karma</title>
        {!! Html::style('css/bootstrap.css') !!}
        {!! Html::style('css/site.css') !!}
    </head>
    <body>
        {!! Html::script('js/app.js') !!}
        {!! Html::script('js/bootstrap.min.js') !!}
        <div class="container-fluid promo">
            <nav class="navbar-dark navbar-fixed-top navbar">
                <div class="container">
                    <div class="navbar-header">
                        <a class="navbar-brand" href="{{ url('/') }}">Karma</a>
                    </div>
                </div>
            </nav>
            @yield('content');
        </div>
    </body>
</html>
