<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- SweetAlert -->
    <link rel="stylesheet" href="{{ asset('css/sweetalert2.min.css') }}">
    <!-- Fontawesome -->
    <link rel="stylesheet" href="{{ asset('css/all.min.css') }}">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    @livewireStyles


</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
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
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Ingresar') }}</a>
                            </li>
                        @else
                            <li class="nav-item dropdown">
                                <input type="hidden" id="user_id" value="{{ Auth::user()->id }}">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('vista.password.cambiar') }}">Cambiar contraseña</a>
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Salir') }}
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
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>

    @livewireScripts
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/main.js') }}"></script>
    <script src="{{ asset('js/egresos.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.0.2/chart.min.js" integrity="sha512-dnUg2JxjlVoXHVdSMWDYm2Y5xcIrJg1N+juOuRi0yLVkku/g26rwHwysJDAMwahaDfRpr1AxFz43ktuMPr/l1A==" crossorigin="anonymous"></script>


    @include('sweet::alert')
    <audio id="success" src="{{ asset('src/correcto.mp3') }}" preload="auto"></audio>
    <audio id="error" src="{{ asset('src/error.mp3') }}" preload="auto"></audio>

    @stack('custom-scripts')

    <script>


        // window.addEventListener('swal:confirm', event => {
        //     swal({
        //         title: event.detail.message,
        //         text: event.detail.text,
        //         icon: event.detail.type,
        //         buttons: true,
        //         dangerMode: true,
        //     })
        //     .then((willDelete) => {
        //         if (willDelete) {
        //             window.livewire.emit('remove');
        //         }
        //     });
        // });
        //
        //
        // // Swal.bindClickHandler('data-swal-template-asd');
        // Swal.mixin({
        //     toast: false,
        // }).bindClickHandler('data-swal-template-asd')
    </script>

    </body>

</html>

