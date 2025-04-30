<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<style>
    body {
        background-color: #f8fafc; /* Couleur de fond claire */
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }
    
    .navbar {
        background-color: #00c0ef; /* Bandeau bleu */
        color: white;
        padding: 10px 20px;
    }
    
    .navbar a {
        color: white;
        text-decoration: none;
        font-weight: bold;
    }
    
    .card {
        border-radius: 8px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        margin-top: 40px;
    }
    
    .card-header {
        background-color: #f1f1f1;
        font-size: 1.2rem;
        font-weight: bold;
        border-bottom: 1px solid #ddd;
    }
    
    .btn-info {
        background-color: #00c0ef;
        border-color: #00c0ef;
        padding: 8px 20px;
        border-radius: 5px;
    }
    
    .btn-info:hover {
        background-color: #00a5cc;
        border-color: #00a5cc;
    }
    
    .btn-link {
        color: #007bff;
        text-decoration: none;
    }
    
    .btn-link:hover {
        text-decoration: underline;
    }
    
    .form-control {
        border-radius: 6px;
        padding: 10px;
        font-size: 0.95rem;
    }
    
    .form-check-label {
        font-size: 0.9rem;
    }

</style>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'DOCFLOW-BANDAMA') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body>
  
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-info shadow-sm ">
            <div class="container ">
                <a class="navbar-brand text-white" href="{{ url('/') }}">
                    {{ config('app.name', 'DOCFLOW-BANDAMA') }}
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item ">
                                    <a class="nav-link text-white" href="{{ route('login') }}">{{ __('Connexion') }}</a>
                                </li>
                            @endif

                             <!-- @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Inscription') }}</a>
                                </li>
                            @endif -->
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>
</html>
