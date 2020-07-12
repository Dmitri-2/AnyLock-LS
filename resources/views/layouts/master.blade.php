<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="icon" href="{{ URL::asset('/img/drop-water.jpg') }}" type="image/x-icon"/>
    <title>{{ config('app.name', 'Water Reuse Directory') }}</title>

    <!-- Scripts - for any compiled site-wide JS -->
    {{--    <script src="{{ asset('js/app.js') }}" defer></script>--}}

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Font Awesome -->
    <script src="{{URL::asset('/libraries/fontawesome.js')}}"></script>

    <!-- Styles -->
    {{--    <link href="{{ asset('css/app.css') }}" rel="stylesheet">--}}
    @stack("css")

    {{--Bootstrap--}}
    <link rel="stylesheet" href="{{ URL::asset('/css/bootstrap.min.css') }}">

</head>
<body>
<div id="app">
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <a class="navbar-brand" href="/">AnyLock</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item active">
                            <a class="nav-link" href="/">Home <span class="sr-only">(current)</span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">About</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Rent</a>
                        </li>
                    </ul>
                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link mx-md-2 px-md-0 pb-md-0 @if (Route::current()->getName() == "login") active @endif" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link mx-md-2 px-md-0 pb-md-0 @if (Route::current()->getName() == "register") active @endif" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                            @else

                                <li class="nav-item dropdown">
                                    <a id="navbarDropdown" class="nav-link pb-md-0 dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                        {{ Auth::user()->name }} <span class="caret"></span>
                                    </a>

                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">

                                        <a class="dropdown-item" href="{{ route('submission') }}">
                                            My Submissions
                                        </a>
                                        <a class ="dropdown-item" href="#">
                                            Account

                                        </a>
                                        <a class="dropdown-item" href="{{ route('logout') }}"
                                           onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            Logout
                                        </a>
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            @csrf
                                        </form>
                                    </div>
                                </li>
                            @endguest
                    </ul>
                </div>
            </nav>

    <main class="py-4">
        @include('layouts.alerts')
        @yield('body')
    </main>
</div>

<script src="{{ URL::asset('/libraries/jquery-3.4.1.slim.min.js') }}"></script>
<script src="{{ URL::asset('/libraries/popper.min.js') }}"></script>
<script src="{{ URL::asset('/libraries/bootstrap.min.js') }}"></script>

@stack("js")

</body>
</html>
