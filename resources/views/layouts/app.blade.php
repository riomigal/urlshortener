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
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"
        integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>

<body>
    <div id="app">
        <!-- Navbar -->

        <!-- Navbar -->
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">
                <nav>
                    <ul class="navbar-nav d-flex flex-row">
                        @auth
                            <li class="nav-item mx-2">
                                <a class="btn btn-primary" href="{{ route('shortlink.create') }}">Add Link</a>
                            </li>
                            <li class="nav-item mx-2">
                                <a class="btn btn-primary" href="{{ route('shortlink.index') }}">My Links</a>
                            </li>
                            <li class="nav-item mx-2">
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <input class="btn btn-primary" type="submit" value="Logout">

                                </form>

                            </li>
                        @else
                            <li class="nav-item mx-2">
                                <a class="btn btn-primary" href="{{ route('register') }}">Register</a>
                            </li>
                            <li class="nav-item mx-2">
                                <a class="btn btn-primary" href="{{ route('login') }}">Login</a>
                            </li>
                        @endauth


                    </ul>
                </nav>
            </div>
        </nav>

        <!-- Navbar -->
        <!-- Navbar -->

        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>

</html>
