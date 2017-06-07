<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <title>Logements Chicoutimi - @yield('title')</title>
    <style type="text/css">
        @yield('style')
    </style>
</head>
<body>

    {{-- Top menu  --}}
    @section('sidebar')

        <nav class="navbar navbar-default">
            <div class="container-fluid">
                <div class="navbar-header">
                    <a class="navbar-brand" href="#">Logements Chicoutimi</a>
                </div>
                <ul class="nav navbar-nav">
                    <li {{{ (Request::is('/') ? 'class=active' : '') }}}><a href="/">Accueil</a></li>
                    <li {{{ (Request::is('sale') ? 'class=active' : '') }}}><a href="/sale">Vendre</a></li>
                </ul>
            </div>
        </nav>

    @show

    {{-- Google Map --}}
    @yield('map')

    {{-- Corps de page  --}}
    <div class="container">
        @yield('content')
    </div>

</body>
</html>