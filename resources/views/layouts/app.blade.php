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

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm d-flex flex-column bd-highlight">
            <div class="container bd-highlight">
                <a class="navbar-brand" href="{{ url('/') }}">
                    <img src="{{ Storage::url('posts/Logo.png') }}" height="60px">                    
                </a>

                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>
                
                <div class="collapse navbar-collapse" id="navbarSupportedContent">

                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav flex-grow-1 bd-highlight">                        
                        <form class="form-inline">
                            <input class="form-control col-7" type="search" placeholder="Que desea buscar?">
                            <button class="btn btn-outline-dark my-2 my-sm-0" type="submit">Buscar</button>
                        </form>
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <!-- Post Link -->
                        <li>
                            <a class="navbar-brand" href="{{ url('/posts/create') }}">Publicar una vivienda</a>
                        </li>
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>

                                    <a class="dropdown-item" href="{{ route('users.edit', Auth::user()->id) }}">
                                        {{ __('Editar') }}
                                    </a>

                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
            
            <div class="container bd-highlight">
                
                    <div class="dropdown bd-highlight">
                        <button type="button" class="btn dropdown-toggle" id="dropdownMenuOffset" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-offset="10,20">
                        Venta
                        </button>
                        
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuOffset">
                        @php
                            $paises = App\Establishment::groupBy('pais')->get(['pais'])
                        @endphp 
                        <a class="dropdown-item" href="{{route('posts.filtro', ['tipo'=> 'Venta'])}}">Todo Ventas</a>                     
                        @foreach ($paises as $pais)
                            <a class="dropdown-item" href="{{route('posts.filtro', ['tipo'=> 'Venta', 'pais'=>$pais->pais])}}">{{$pais->pais}}</a>
                        @endforeach
                        </div>
                    </div>

                    <div class="dropdown bd-highlight">
                        <button type="button" class="btn dropdown-toggle" id="dropdownMenuOffset" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-offset="10,20">
                        Alquiler
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuOffset">
                            @php
                                $paises = App\Establishment::groupBy('pais')->get(['pais'])
                            @endphp     
                            <a class="dropdown-item" href="{{route('posts.filtro', ['tipo'=> 'Alquiler'])}}">Todo Alquiler</a>                    
                            @foreach ($paises as $pais)
                                <a class="dropdown-item" href="{{route('posts.filtro', ['tipo'=> 'Alquiler', 'pais'=>$pais->pais])}}">{{$pais->pais}}</a>
                            @endforeach
                        </div>
                    </div>

                    <div class="ml-auto p-2 bd-highlight">
                        <a href="" class="text-body">Ayuda</a>
                    </div>
                             
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>
</html>
