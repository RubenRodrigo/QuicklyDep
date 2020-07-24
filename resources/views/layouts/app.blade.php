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
    <!-- Fonts -->
    <script src="https://kit.fontawesome.com/ae99943a7e.js" crossorigin="anonymous"></script>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/index.css') }}">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm d-flex flex-column bd-highlight">
            <div class="container bd-highlight">
                <a class="navbar-brand" href="{{ url('/') }}">
                    <img src="{{ asset('img//Logo.png') }}" height="60px">                    
                </a>

                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>
                
                <div class="collapse navbar-collapse row" id="navbarSupportedContent">

                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav col-md-8">                        
                        <form class="col-md-12 row p-0 m-0 busqueda" method="GET" action="{{ route('posts.search')}}">
                            <!-- Se controla que la variable search exista-->                            
                            <div class="col-md-8">                                
                                <input class="form-control form-control-navbar" name="search" type="search" placeholder="Que desea buscar?" aria-label="Search">
                                                                
                            </div>
                            <div class="col-md-4">
                                <button class="btn btn-outline-dark my-2 my-sm-0" type="submit">Buscar</button>
                            </div>                            
                                                     
                        </form>
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav col-md-4 p-0">

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
                                    <img src="data:image/png;base64,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" style="width:32px; height:32px; top:10px; left:10px; border-radius:50%">
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    @if(empty(Auth::user()->notifications))
                                        <a class="dropdown-item">No hay notificaciones</a>
                                    @else
                                        @foreach (Auth::user()->notifications as $notification)
                                            <a class="dropdown-item" href="{{ action('PostController@show',$notification->data['idPost']) }}">
                                            {{$notification->data['data']}}</a>
                                        @endforeach
                                    @endif
                                </div>
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>

                                    @isset(Auth::user()->img_profile)
                                    
                                    <img src="{{ Storage::url( Auth::user()->img_profile) }}" style="width:32px; height:32px; top:10px; left:10px; border-radius:50%"><span class="caret"></span>
                                    @else
                                     {{Auth::user()->name}}<img src="https://static.vecteezy.com/system/resources/previews/000/550/731/non_2x/user-icon-vector.jpg" style="width:32px; height:32px; top:10px; left:10px; border-radius:50%"><span class="caret"></span>
                                    @endisset
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">

                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <a class="dropdown-item" href="{{ route('users.edit', Auth::user()->id) }}">
                                        {{ __('Perfil') }}
                                    </a>

                                    <a class="dropdown-item" href="{{ action('UserController@showNotifications',Auth::user()->id) }}">
                                        Revisar notificaciones
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
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
                            $distritos = App\Establishment::groupBy('distrito')->get(['distrito'])
                        @endphp 
                        <a class="dropdown-item" href="{{route('posts.filtro', ['tipo'=> 'Venta'])}}">Todo Ventas</a>                     
                        @foreach ($distritos as $distrito)
                            <a class="dropdown-item" href="{{route('posts.filtro', ['tipo'=> 'Venta', 'distrito'=>$distrito->distrito])}}">{{$distrito->distrito}}</a>
                        @endforeach
                        </div>
                    </div>

                    <div class="dropdown bd-highlight">
                        <button type="button" class="btn dropdown-toggle" id="dropdownMenuOffset" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-offset="10,20">
                        Alquiler
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuOffset">
                            @php
                                $distritos = App\Establishment::groupBy('distrito')->get(['distrito'])
                            @endphp     
                            <a class="dropdown-item" href="{{route('posts.filtro', ['tipo'=> 'Alquiler'])}}">Todo Alquiler</a>                    
                            @foreach ($distritos as $distrito)
                                <a class="dropdown-item" href="{{route('posts.filtro', ['tipo'=> 'Alquiler', 'distrito'=>$distrito->distrito])}}">{{$distrito->distrito}}</a>
                            @endforeach
                        </div>
                    </div>

                    <div class="ml-auto p-2 bd-highlight">
                        <a href="" class="text-body"></a>
                    </div>
                             
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>
</html>
