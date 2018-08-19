<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <meta property="og:type" content="website">
    <meta property="og:url" content="http://{{ $_SERVER['HTTP_HOST'] }}/">
    <meta property="og:title" content="Výzva dne">
    <meta property="og:image" content="http://www.vyzvadne.cz/img/vyzva001.jpg">
    <meta property="og:description" content="Skupinu na FB i webovou stránku jsem vytvořil pro všechny, kdo mají rádi výzvy. Na webu se můžete inspirovat a přidat se ke skupině lidí, která se nebojí výzev. Stránka právě vznikla a moc výzev zde není, můžete sami přidávat nové výzvy (a to i anonymně). Věřím, že každé překročení svých hranic nás posune kousek dál. Rady, návody, Vaše příběhy a jiné informace můžete vkládat do skupiny na FB. Stále váháte? Přijměte výzvu a zapojte se :)">
    <meta property="fb:app_id" content="726284111042670">

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css"
          integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">
</head>
<body>
<div id="fb-root"></div>
<script>(function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s); js.id = id;
        js.src = 'https://connect.facebook.net/cs_CZ/sdk.js#xfbml=1&version=v3.1&appId=726284111042670&autoLogAppEvents=1';
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));</script>

<div id="app" style="min-height: calc(100vh - 30px)">
    <nav class="navbar navbar-expand-md navbar-light navbar-laravel">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">
                {{ config('app.name', 'Laravel') }}
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent" aria-expanded="false"
                    aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Left Side Of Navbar -->
                <ul class="navbar-nav mr-auto">

                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ml-auto">
                    <!-- Authentication Links -->
                    @guest
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Přihlásit') }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Registrace') }}</a>
                        </li>
                    @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                {{--<a class="dropdown-item" href="/profil">Profil</a>--}}
                                <a class="dropdown-item" href="/historie">Historie výzev</a>

                                <a class="dropdown-item" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    {{ __('Odhlásit') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                      style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>

    <main class="py-4 container">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if (Session::has('message'))
            <div class="alert alert-info">
                {{ Session::get('message') }}
            </div>
        @endif

        @yield('content')
    </main>
</div>

<div class="container align-text-bottom">
    <div class="float-right">
        <a href="/ochrana-osobnich-udaju">Ochrana osobních údajů</a>
    </div>
    <div>Michal Nosavcov, e-mail: <a href="mailto:mnosavcov@gmail.com">mnosavcov@gmail.com</a></div>
</div>

<?php if(empty($_COOKIE['eu-cookies'])) { ?>
<script>
    function euCookiesButtonOk() {
        var d = new Date();
        d.setTime(d.getTime() + (7776000000)); //90*24*60*60*1000 = 90 dní
        var expires = "expires="+d.toUTCString();
        document.cookie = "eu-cookies=1; " + expires + "; path=/";

        $('.eu-cookies').slideUp();
    }
</script>
<div class="eu-cookies">
    <div style="width: 950px; margin: 0 auto; text-align: left;">
        <button type="button" onclick="euCookiesButtonOk();">Souhlasím</button>
        Tento web používá k poskytování služeb a analýze návštěvnosti soubory cookie. Používáním tohoto webu s tím souhlasíte.
        <a href="https://www.google.com/policies/technologies/cookies/" target="_blank">Další informace</a>
    </div>
</div>
<noscript><style>.eu-cookies { display:none }</style></noscript>
<style>
    .eu-cookies {
        position: fixed;
        left: 0;
        bottom: 0;
        width: 100%;
        color: white;
        background-color: #696969;
        z-index: 1000;
        padding: 15px 0;
        line-height: 200%;
    }

    .eu-cookies button {
        background: #2cafe3;
        color: white;
        border: none;
        padding: 5px 10px;
        float: right;
    }
</style>
<?php } ?>

</body>
</html>
