<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/bootstrap.css') }}" rel="stylesheet">
    <link href="{{ asset('css/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">

</head>

<body>
    <div id="app">
        <nav class="navbar navbar-dark bg-dark navbar-expand-lg">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse"
                    data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                    aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                        @if (Auth::check())
                            <li class="nav-item">
                                <a id="navbarDropdown" class="nav-link" href="{{ route('horarioAula') }}">Horario
                                    Aulas</a>
                            </li>

                            <li class="nav-item">
                                <a id="navbarDropdown" class="nav-link" href="{{ route('usuarios') }}">Usuarios</a>
                            </li>

                            <li class="nav-item">
                                <a id="navbarDropdown" class="nav-link" href="{{ route('materias') }}">Materias</a>
                            </li>

                            <li class="nav-item">
                                <a id="navbarDropdown" class="nav-link" href="{{ route('aulasAlunos') }}">Alunos
                                    Aulas</a>
                            </li>

                            <li class="nav-item">
                                <a id="navbarDropdown" class="nav-link" href="">Permissão</a>
                            </li>
                        @endif
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            {{-- @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif --}}
                        @else
                            <li class="nav-item">
                                <a id="navbarDropdown" class="nav-link text-danger" href="{{ url('/logout') }}">Sair</a>
                            </li>

                            <li class="nav-item">
                                <p id="navbarDropdown" style="margin: 0" class="nav-link  text-success">
                                    {{ Auth::user()->name }}</p>
                            </li>

                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>

        <script src="{{ asset('js/jquery.js') }}"></script>
        <script src="{{ asset('js/bootstrap.js') }}"></script>
        <script src="{{ asset('js/sweetalert.min.js') }}"></script>

        @stack('scripts')

        <script>
            function convertDate(date) {
                function pad(s) {
                    return (s < 10) ? '0' + s : s;
                }
                var d = new Date(date)
                return [pad(d.getDate()), pad(d.getMonth() + 1), d.getFullYear()].join('/')
            }
        </script>
    </div>
</body>

</html>
