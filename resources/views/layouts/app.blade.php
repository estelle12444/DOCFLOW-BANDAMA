<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<style>
    /* styles/app.css ou dans resources/sass/app.scss */
    body {
        background-color: #f8f9fa;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }
    
    .container {
        margin-top: 5rem;
    }
    
    .card {
        border: none;
        border-radius: 10px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
    }
    
    .card-header {
        background-color: #17a2b8; /* Couleur info Bootstrap */
        color: white;
        font-size: 1.5rem;
        font-weight: bold;
        text-align: center;
        padding: 1.5rem;
        border-radius: 10px 10px 0 0 !important;
    }
    
    .card-body {
        padding: 2.5rem;
    }
    
    .form-control {
        border: 1px solid #ced4da;
        border-radius: 5px;
        padding: 0.75rem 1rem;
        margin-bottom: 0.5rem;
    }
    
    .form-control:focus {
        border-color: #17a2b8;
        box-shadow: 0 0 0 0.25rem rgba(23, 162, 184, 0.25);
    }
    
    .btn-info {
        background-color: #17a2b8;
        border: none;
        padding: 0.5rem 2rem;
        font-weight: 600;
        transition: all 0.3s;
    }
    
    .btn-info:hover {
        background-color: #138496;
        transform: translateY(-2px);
    }
    
    .btn-link {
        color: #17a2b8;
        text-decoration: none;
    }
    
    .btn-link:hover {
        text-decoration: underline;
    }
    
    .form-check-input:checked {
        background-color: #17a2b8;
        border-color: #17a2b8;
    }
    
    .invalid-feedback {
        color: #dc3545;
        font-size: 0.875rem;
    }
    
    /* Style spécifique pour le titre "DOCFLOW-BANDAMA" */
    .login-title {
        text-align: center;
        color: #343a40;
        margin-bottom: 2rem;
        font-size: 2rem;
        font-weight: bold;
    }
    
    /* Responsive adjustments */
    @media (max-width: 768px) {
        .col-md-4.text-md-end {
            text-align: left !important;
        }
        
        .col-md-6 {
            width: 100%;
        }
        
        .offset-md-4 {
            margin-left: 0;
        }
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
