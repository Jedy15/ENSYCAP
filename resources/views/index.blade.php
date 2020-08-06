<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Ensycap</title>

        <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    </head>
    <body>
        <div id="app">
            <header>
                <nav class="navbar fixed-top navbar-expand-lg navbar-light bg-light">
                    <a class="navbar-brand" href="url('/')">
                        ENSYC<img src="{{ asset('theme/img/icon.svg') }}" width="30" height="30" class="d-inline-block align-top" alt="" loading="lazy">P
                    </a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
                        <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                            <li class="nav-item active">
                                <a class="nav-link" href="#">Inicio <span class="sr-only">(current)</span></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">Acerca de</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">Contacto</a>
                            </li>
                        </ul>
                        @guest
                            <form class="form-inline" method="POST" action="{{ route('login') }}">
                                @csrf
                                <input id="email" type="email" class="form-control mr-sm-2 @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required placeholder="Correo Electrónico" autocomplete="email" autofocus>
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                <input id="password" type="password" class="form-control mr-sm-2 @error('password') is-invalid @enderror" name="password" required placeholder="Contraseña" autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                <button class="btn btn-outline-primary my-2 my-sm-0" type="submit">Ingresar</button>
                            </form>
                        @else
                            <span class="navbar-text mr-sm-2">
                                {{ Auth::user()->name }}
                            </span>
                            <div class="form-inline">
                                <a class="btn btn-sm btn-outline-success mr-sm-2" href="{{ route('home') }}">Ingresar</a>
                                <a class="btn btn-sm btn-outline-danger mr-sm-2" href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                                document.getElementById('logout-form').submit();">
                                    {{ __('Cerrar Sesión') }}
                                </a>
                            </div>
                            
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        @endguest

                    </div>
                </nav>
            </header>

            <div class="jumbotron">
                <div class="card mb-12">
                    <div class="row">                
                        <div class="col-md-6">
                            <img src="{{ asset('theme/img/Login.png') }}" class="card-img" alt="...">
                        </div>

                        <div class="col-md-6">
                            <div class="card-body">
                                <h2 class="card-title">Sistema de Enseñanza y Capacitación</h2>
                                <p class="lead card-text">
                                    Ensycap es una aplicación web que esta diseñado para llevar el control de Capacitación de cada 
                                    uno de los trabajadores del sistema de Salud del estado de Chiapas, asi como la agenda de eventos, 
                                    asistencia de cada evento y generar reporte de cardex de Capacitación.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- <div class="col-md-9 col-xl-8 py-md-3 pl-md-5 bd-content">  
                    <div class="row flex-xl-nowrap" id="about">
                        <div class="col-12">
                            <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                                <div class="carousel-inner">
                                    <div class="carousel-item active">
                                    <img src="" class="d-block w-100" alt="Imagen 1">
                                    </div>
                                    <div class="carousel-item">
                                    <img src="" class="d-block w-100" alt="Imagen 2">
                                    </div>
                                    <div class="carousel-item">
                                    <img src="" class="d-block w-100" alt="Imagen 3">
                                    </div>
                                </div>
                                <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="sr-only">Previous</span>
                                </a>
                                <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="sr-only">Next</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div> -->
                @yield('content')
            </div>
        </div>
        <script src="{{ asset('js/app.js') }}"></script>
    </body>
</html>
