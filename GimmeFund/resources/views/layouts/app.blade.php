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
     {{-- Includo il js per le icone  --}}
     <script defer src="{{ asset('js/fonts/all.js') }}"></script>
     {{-- Includo il js per Chart.js --}}
     <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
     <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.min.js" integrity="sha512-d9xgZrVZpmmQlfonhQUvTR7lMPtO7NkZMkA0ABN3PHCbKA5nqylQ/yWlFAyY6hYgdF1Qh6nYiuADWwKB4C2WSw==" crossorigin="anonymous"></script>
     <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    {{-- Includo il css per le icone  --}}
    <link href="{{ asset('css/fontawesome.css') }}" rel="stylesheet" type="text/css">


    <!-- Styles -->
    <link rel="stylesheet" href= "https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <link type="text/css" rel="stylesheet" href={{ URL::asset('css/stili.css') }}>
    @yield('style')
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm navbar1">
            <div class="container-fluid">
                <a class="navbar-brand navbar-a" href="{{ url('/') }}">
                    <i class="fas fa-hand-holding-usd"></i> {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">
                        <li class="">
                            <a class="nav-link navbar-a" href="{{ URL::action('FundraiserController@index') }}" class="nav-link">
                                <i class="fas fa-hands-helping"></i> Raccolte fondi
                            </a> 
                        </li >
                         <li class="">
                            <a class="nav-link navbar-a" href="{{ url('/whoweare') }}" class="nav-link">
                                <i class="fas fa-users"></i> Chi siamo
                            </a>
                        </li>
                        <li class="">
                            <a class="nav-link navbar-a" href="#" class="nav-link">
                                <i class="fas fa-info-circle"></i> Informazioni
                            </a>
                        </li>
                        <li class="">
         t                   <a class="nav-link navbar-a" href="#" class="nav-link">
                                <i class="fas fa-joint"></i> Sostienici
                            </a>
                        </li>
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        @if (Auth::user())
                            <li class="nav-item">
                                <a href="{{ URL::action('FundraiserController@create') }}" class="btn btn-info btn-rounded px-3 my-0 d-none d-lg-inline-block" style="background-color: #54be90 !important;"{{-- class="btn btn-campagna --}}>
                                    Inizia la tua campagna ora!
                                </a> 
                                {{-- <a class="btn btn-info btn-sm btn-rounded px-3 my-0 d-none d-lg-inline-block"
                                   href="{{ URL::action('FundraiserController@create') }}" target="_blank"
                                   role="button"
                                   style="background-color: #54be90 !important;">
                                <span>Inizia la tua campagna ora!</span>
                                </a> --}}
                                {{-- <button type="button" class="btn btn-success btn-rounded" onclick=" window.open('fundraiser/create','_blank')">Success</button> --}}
                            </li>
    
                        @endif
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link navbar-a" href="{{ route('login') }}">Accedi</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link navbar-a" href="{{ route('register') }}">Registrati</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                
                                <a id="navbarDropdown" class="nav-link dropdown-toggle navbar-a" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    <i class="far fa-user">&nbsp;</i> {{ Auth::user()->first_name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-right navbar-li" aria-labelledby="navbarDropdown">
                                    {{-- Direttiva blade @can: serve per l'admin --}}
                                    @can('manage-users')
                                        <a class="dropdown-item navbar-a" href="{{ URL::action('Admin\UsersController@index') }}">
                                            <i class="fas fa-users-cog"></i> Gestione utenti
                                        </a>    
                                    @endcan
                                    @if (Auth::user()->hasRole('user'))
                                        <a href="{{ URL::action('UserController@edit', Auth::user()) }}" class="dropdown-item navbar-a">
                                            <i class="fas fa-user-cog"></i> I miei dati 
                                        </a>
                                        <a href="{{ URL::action('CouponController@index', Auth::user()) }}" class="dropdown-item navbar-a">
                                            <i class="fas fa-money-bill-alt"></i> Saldo punti e Coupon
                                        </a>
                                    @endif
                                    <a class="dropdown-item navbar-a" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        <i class="fas fa-sign-out-alt"></i> Logout
                                    </a>
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
            in /public/fonts/ ci metto tutte le svg che voglio usare (specifiche).
            Dal sito devo salvarmi la svg e metterla dentro /public/fonts --}}
            {{-- Provo ad usare il file css per le icone --}}
            {{-- <p>QUESTE SONO ALCUNE ICONE DI PROVA DA METTERE AD ESEMPIO NEI PULSANTI DELLA NAVBAR O NEI FORM</p>
            <i class="far fa-angry"></i> <p>faccina arrabbiata</p> --}}
            {{-- Provo ad usare il file js per le icone --}}
            {{-- <i class="fas fa-home"></i><p>Home</p> 
            <i class="fas fa-user"></i> <p>Utente 1</p>
            <i class="far fa-user"></i> <p>Utente 2</p> 
            <i class="fal fa-user"></i> <p>Utente 3</p>
            <i class="fab fa-github-square"></i> 
            <i class="fas fa-sign-in-alt"></i> <p>log in</p>  
            <i class="far fa-credit-card"></i> <p>Carta di credito</p>
            <i class="fas fa-wallet"></i><p>Portafoglio</p>
            <i class="fad fa-cart-plus"></i> <p>carrello</p>
            <i class="fas fa-shopping-cart"></i><p>Soldi</p>
            <i class="fas fa-users"></i><p>Chi siamo</p> --}}
        {{-- FINE PROVA ICONE --}}

        <main>
            {{-- Includo la cartella creata con il file degli alerts --}}
            @include('partials.alerts')
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

                {{-- LOGHIIIII --}}
                <!-- Facebook -->
                <a class="btn btn-primary" style="background-color: #3b5998" href="#!" role="button">
                    <i class="fab fa-facebook-f"></i>
                </a>

                <!-- Twitter -->
                <a class="btn btn-primary" style="background-color: #55acee" href="#!" role="button">
                    <i class="fab fa-twitter"></i>
                </a>

                <!-- Instagram -->
                <a class="btn btn-primary" style="background-color: #ac2bac" href="#!" role="button">
                    <i class="fab fa-instagram"></i>
                </a>

                <!-- Linkedin -->
                <a class="btn btn-primary" style="background-color: #0082ca" href="#!" role="button">
                    <i class="fab fa-linkedin-in"></i>
                </a>

                <!-- Youtube -->
                <a class="btn btn-primary" style="background-color: #ed302f" href="#!" role="button">
                    <i class="fab fa-youtube"></i>
                </a>

               {{-- FINE LOGHIIII --}}
                <p class="lead footer-privacy">Cookies<br/>Policy<br/>&copy; All Rights Reserved</p>
            </div>
        </div>
    </div>
    {{-- Inclusione della sezione script della view --}}
    @yield('script')
</body>
</html>
