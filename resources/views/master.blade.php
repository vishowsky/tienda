<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title') - tienda</title>
    <meta name="csrf_token" content="{{ csrf_token() }}">
    <meta name="routeName" content="{{ Route::currentRouteName() }}">

    <!-- font awesome -->
    <script src="https://kit.fontawesome.com/09afb5370b.js" crossorigin="anonymous"></script>


    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    <!-- jquery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>


    <link rel="stylesheet" href="{{ url('/static/css/style.css?v=' . time()) }}">

    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js"
        integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous">
    </script>

    <!-- ckeditor -->
    <script src="{{ url('/static/libs/ckeditor/ckeditor.js') }}"></script>

    <script src="{{ url('/static/js/site.js?v=' . time()) }}"></script>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.css" />
    <script src="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.js"></script>

    <!-- sweet alert-->
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    <script>
        $(document).ready(function() {
            $('[data-toggle="tooltip"]').tooltip()
        });
    </script>

</head>

<body>

<nav class="navbar navbar-expand-lg shadow">
    <div class="container-fluid">
        <a href="{{ '/' }}" class="navbar-brand"><img src="{{ url('/static/images/logo.png') }}" alt=""></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon">
            </span>
        </button>

        <div class="collapse navbar-collapse" id="navbarText">
            <ul class="navbar-nav ms-auto">
                <li class=" nav-item">
                    <a href="{{ url('/') }}" class="nav-link">Inicio</a>
                </li>
                <li class=" nav-item">
                    <a href="{{ url('/') }}" class="nav-link">Tienda</a>
                </li>
                <li class=" nav-item">
                    <a href="{{ url('/') }}" class="nav-link">Sobre Nosotros</a>
                </li>
                <li class=" nav-item">
                    <a href="{{ url('/') }}" class="nav-link">Contacto</a>
                </li>
                <li class=" nav-item">
                    <a href="{{ url('/') }}" class="nav-link"><i class="fas fa-shopping-cart"></i>
                    <span class="carnumber">
                        0
                    </span>
                </a>
                </li>
                @if(Auth::guest())
                <li class=" nav-item">
                    <a href="{{ url('/login') }}" class="nav-link btn">Ingresar</a>
                </li>
                <li class=" nav-item">
                    <a href="{{ url('/register') }}" class="nav-link btn">Crear cuenta</a>
                </li>
                @else
                <li class=" nav-item link-acc link-user dropdown">
                    <a href="{{ url('/register') }}" class="nav-link btn dropdown-toggle"
                    id="navbarDropdown" role="button" data-toggle="dropdown" aria-expanded="false"
                    >@if(is_null(Auth::user()->avatar))
                        <img src="{{ url('/static/images/default-avatar.png') }}" alt=""> @endif {{ Auth::user()->name}} {{ Auth::user()->lastname}}</a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            @if(Auth::user()->role == "1")
                            <li><a class="dropdown-item" href="{{ url('/admin') }}">Panel Administrativo</a></li>
                            @endif

                            <li><a class="dropdown-item" href="">Cuenta</a></li>
                            <li><a class="dropdown-item" href="{{ url('/account/edit') }}">Editar informacion</a></li>
                            <li><a class="dropdown-item" href="{{ url('/logout') }}">Cerrar sesion</a></li>

                        </ul>
                </li>
                @endif
            </ul>

        </div>

    </div>
</nav>

    <!-- Alertas -->
    @if (Session::has('message'))
        <div class="container">
            <div class="mt16 alert alert-{{ Session::get('typealert') }}" style="display:none;">
                {{ Session::get('message') }}
                @if ($errors->any())
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                @endif
                <script>
                    //script para la animacion
                    $('.alert').slideDown();
                    setTimeout(function() {
                        $('.alert').slideUp();
                    }, 10000)
                </script>
            </div>
        </div>
    @endif

    <div class="wrapper">
        <div class="container">
            @yield('content')

        </div>
    </div>

</body>

</html>