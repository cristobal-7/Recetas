<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
   

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Rereceta') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.2.0/sweetalert2.min.css">
    <script src="{{asset('https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.2.0/sweetalert2.all.min.js') }}"></script> 
    
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    @yield('styles')

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-primary shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Receta') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
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
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Iniciar Sesión') }}</a>
                            </li> 
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Registrarse') }}</a>
                                </li>
                            @endif
                        
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a 
                                        class="dropdown-item" href="{{ route('perfiles.show', ['perfil' => Auth::user()->id]) }}">
                                        {{ 'Perfil' }}
                                    </a>

                                    <a 
                                        class="dropdown-item" href="{{ route('recetas.index') }}">
                                        {{ 'Ver Recetas' }}
                                    </a>
                                    
                                    <a
                                        class="dropdown-item" href="{{ route('perfiles.edit', ['perfil' => Auth::user()->id]) }}">
                                        {{ 'Editar Perfil' }}
                                    </a>

                                    <a
                                        class="dropdown-item" href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Cerrar Sesión') }}
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

        <nav class="navbar navbar-expand-md navbar-light categorias-bg">
            <div class="container">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#categorias" aria-controls="categorias" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                    Categorias
                </button>
                <div class="collapse navbar-collapse " id="categorias">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav w-100 d-flex justify-content-between">
                        @foreach ($categorias as $categoria)
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('categorias.show', ['categoriaReceta' => $categoria->id ]) }}"> 
                               {{ $categoria->nombre }}
                            </a>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </nav>


        @yield('hero')

        <div class="container">
            <div class="row">
                <div class="my-5 mt-5 col-12">
                    @yield('botones')
                </div>
            
                <main class="py-4 m-5 col-12">
                    @yield('content')
                </main>
            </div>
        </div>

      
    </div>
    
    @yield('scripts')
    
    
</body>
</html>

<!-- Comentarios del Codigo -->
 <!-- yield('content') es un espacio para insertar contenido html / como lo esta en recetas.index -> @section('content')-> llamamos al contenedor para mostrar la información -->
