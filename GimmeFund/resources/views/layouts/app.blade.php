{{-- Questa pagina contiene il layout che si replicherà in tutte le altre pagine  --}}
<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    {{-- Includo il js per le icone  --}}
    <script defer src="{{ asset('js/fonts/all.js') }}"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    {{-- Includo il css per le icone  --}}
    <link href="{{ asset('css/fontawesome.css') }}" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <link type="text/css" rel="stylesheet" href={{ URL::asset('css/stili.css') }}>

    @yield('style')
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm navbar1">
            <div class="container">
                <a class="navbar-brand navbar-a" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">
                        <li>
                            <a class="nav-link navbar-a" href="{{ URL::action('FundraiserController@index') }}" class="nav-link">
                                Raccolte fondi
                            </a>
                        </li>
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        @if (Auth::user())
                            <li class="nav-item">
                                <a href="{{ URL::action('FundraiserController@create') }}" class="btn btn-campagna">
                                    Inizia la tua campagna ora!
                                </a>
                            </li>
    
                        @endif
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link navbar-a" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link navbar-a" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle navbar-a" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->first_name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-right navbar-li" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item navbar-a" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>
                                    {{-- Direttiva blade @can: serve per l'admin --}}
                                    @can('manage-users')
                                        <a class="dropdown-item navbar-a" href="{{ URL::action('Admin\UsersController@index') }}">
                                            Gestione utenti
                                        </a>    
                                    @endcan
                                    @if (Auth::user()->hasRole('user'))
                                        <a href="{{ URL::action('UserController@edit', Auth::user()) }}" class="dropdown-item navbar-a">
                                            Anagrafiche 
                                        </a>
                                        <a href="{{ URL::action('CouponController@index') }}" class="dropdown-item navbar-a">
                                            Saldo punti donazioni
                                        </a>
                                    @endif
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                        {{-- Fine parte destra della navbar --}}
                    </ul>
                </div>
            </div>
        </nav>

        {{-- PRVOA ICONE
            visitare il sito: https://fontawesome.com/icons/sign-out-alt?style=solid
            in /public/fonts/ ci metto tutte le svg che voglio usare (specifiche) --}}
            {{-- Provo ad usare il file css per le icone --}}
            <p>QUESTE SONO ALCUNE ICONE DI PROVA DA METTERE AD ESEMPIO NEI PULSANTI DELLA NAVBAR O NEI FORM</p>
            <i class="far fa-angry"></i> <p>faccina arrabbiata</p>
            {{-- Provo ad usare il file js per le icone --}}
            <i class="fas fa-home"></i><p>Home</p> {{-- Home --}}
            <i class="fas fa-user"></i> <p>Utente 1</p><!-- uses solid style -->
            <i class="far fa-user"></i> <p>Utente 2</p> <!-- uses regular style -->
            <i class="fal fa-user"></i> <p>Utente 3</p><!-- uses light style -->
            <i class="fab fa-github-square"></i> <!-- uses brands style -->
            <i class="fas fa-sign-in-alt"></i> <p>log in</p> {{-- log in --}} 
            <i class="fas fa-sign-out-alt"></i> <p>log out</p> 
            <i class="far fa-credit-card"></i> <p>Carta di credito</p>{{-- Carta di credito --}}
            <i class="fas fa-wallet"></i><p>Portafoglio</p>
        {{-- FINE PROVA ICONE --}}

        <main class="py-4">
            {{-- Includo la cartella creata con il file degli alerts --}}
            <div class="container">
                @include('partials.alerts')
            </div>
            {{-- Inclusione del contenuto di una view nel layout --}}
            @yield('content')
        </main>
        <div class="jumbotron-fluid">
            <div class="container">
                <h2>
                    <a class="footer-logo" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}</a>
                </h2>
                {{-- INSERIRE I LOGHI NEL FOOTER !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!--}}
                <p class="lead footer-privacy">Cookies<br/>Policy<br/>&copy; All Rights Reserved</p>
            </div>
        </div>
        @yield('footer')
    </div>
    {{-- Inclusione della sezione script della view --}}
    @yield('script')
</body>
</html>
