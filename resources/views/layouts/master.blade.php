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

    <style>
        html, body, .app{
            width: 100%;
            height: 100%;
            margin: 0;
        }

        .sidebar, .content {
            height: 100%;
            overflow:auto;
            float:left;
        }

        .sidebar {
            background:white;
            width: 15%;
        }

        .content {
            width: 85%;
        }

        /*.nav-item:hover {*/
            /*padding: 10px;*/
        /*}*/

        /*
         Sidebar design and styling is based on the following guides, with minor code excerpts used from them:
            https://bootstrapious.com/p/bootstrap-sidebar
            https://medium.com/@davidmellul/make-a-sidebar-for-your-website-the-easy-way-html5-css3-vanillajs-eccbb4d0cff6
        */

    </style>

</head>
<body>
<div class="app">
    <nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">
        <a class="navbar-brand" href="/">AnyLock Locker System </a>
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
    </nav>
        <nav class="sidebar border-right">
            <div class="" id="">
                <ul class="list-unstyled" >
                    <li class="nav-item">
                        <a class="d-block p-3 bg-light text-dark text-decoration-none" href="/">Home <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item border-top">
                        <a class="d-block p-3 bg-light text-dark text-decoration-none" href="#">About</a>
                    </li>
                    <li class="nav-item border-top border-bottom">
                        <a class="d-block p-3 bg-light text-dark text-decoration-none" href="#">Rent</a>
                    </li>
                    <li class="nav-item border-top border-bottom">
                        <a class="d-block p-3 bg-light text-dark text-decoration-none" href={{route('userStatus')}}>Status</a>
                    </li>
                    <li class="nav-item border-top border-bottom">
                        <a class="d-block p-3 bg-light text-dark text-decoration-none" href="/lockerIssues">Locker Issues</a>
                    </li>
                </ul>
            </div>
        </nav>

        <main class="content mt-4">
            @include('layouts.alerts')
            @yield('body')
        </main>
    </div>



</div>

<script src="{{ URL::asset('/libraries/jquery-3.4.1.slim.min.js') }}"></script>
<script src="{{ URL::asset('/libraries/popper.min.js') }}"></script>
<script src="{{ URL::asset('/libraries/bootstrap.min.js') }}"></script>

@stack("js")

</body>
</html>
