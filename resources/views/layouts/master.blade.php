<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="icon" href="{{ URL::asset('/img/drop-water.jpg') }}" type="image/x-icon"/>
    <title>{{ config('app.name', 'AnyLock Locker System') }}</title>

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

    <!-- Jquery -->
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>

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
            background-color: white;
            width: 15%;
        }



        .sidebar-item {
            color: black;
            background-color: white;
        }

        .sidebar-item:hover {
            background-color: rgba(212, 52, 52, 0.49);
        }

        .sidebar-group {
            list-style: none;
            border-radius: 10px;
            box-shadow: 0px 2px 12px rgba(50, 50, 50, 0.32) !important;
            border: 1px rgba(80, 105, 107, 0.29) solid;
            padding: 0px;
            margin: 14px;
        }

        .sidebar-group :first-child{
            border-radius: 10px 10px 0px 0px;
        }

        .sidebar-group :last-child{
            border-radius: 0px 0px 10px 10px;
        }


        .sidebar-link {
            color: #394c50;
            font-weight: 500;
            padding: 10px;
        }

        .sidebar-link:hover {
            color: black;
        }

        .active {
            background-color: #b3333345 !important;
        }

        .active-top {
            font-weight: 600;
        }

        @media (max-width: 992px){
            .auth-links{
                display: none;
            }
            .mobile-links{
                display: block;
            }
            .content {
                width: 100%;
            }
        }

        @media (min-width: 992px){
            #mobile-nav-content{
                display: none !important;
            }
            .content {
                width: 85%;
            }
        }

        /*
         Sidebar design is based on the following guides, with minor code excerpts used from them:
            https://bootstrapious.com/p/bootstrap-sidebar
            https://medium.com/@davidmellul/make-a-sidebar-for-your-website-the-easy-way-html5-css3-vanillajs-eccbb4d0cff6
        */

    </style>

</head>
<body>
<div class="app">
    <nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">
        <a class="navbar-brand" href="/">AnyLock Locker System </a>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#mobile-nav-content" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>


        {{--TOP DROPDOWN MENU FOR MOBILE --}}
        <div class="collapse navbar-collapse mobile-links" id="mobile-nav-content">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link @if (Route::current()->getName() == "home") active-top @endif" href="{{ route('home') }}">Home </a>
                </li>

                <li class="nav-item @if (Route::current()->getName() == "about") active-top @endif">
                    <a class="nav-link" href="{{route("about")}}">About</a>
                </li>
                @auth
                    <li class="nav-item @if (Route::current()->getName() == "rent") active-top @endif">
                        <a class="nav-link" href="{{route("rent")}}">Rent a Locker</a>
                    </li>

                    <li class="nav-item @if (Route::current()->getName() == "userStatus") active-top @endif">
                        <a class="nav-link" href="{{route("userStatus")}}">My Lockers</a>
                    </li>

                    @if(Auth::check() && Auth::user()->is_admin)

                        <li>
                            <h5 class="mt-3">Admin Pages</h5>
                        </li>

                        <li class="nav-item @if (Route::current()->getName() == "adminDashboard") active-top @endif">
                            <a class="nav-link" href="{{route("adminDashboard")}}">Dashboard</a>
                        </li>
                        <li class="nav-item @if (Route::current()->getName() == "allRentals") active-top @endif">
                            <a class="nav-link" href="{{route("allRentals")}}">All Rentals</a>
                        </li>
                        <li class="nav-item @if (Route::current()->getName() == "pendingRentals") active-top @endif">
                            <a class="nav-link" href="{{route("pendingRentals")}}">Pending Rentals</a>
                        </li>
                        <li class="nav-item @if (Route::current()->getName() == "lockerIssues") active-top @endif">
                            <a class="nav-link" href="{{route("lockerIssues")}}">Locker Issues</a>
                        </li>
                        <li class="nav-item @if (Route::current()->getName() == "expiry_list") active-top @endif">
                            <a class="nav-link" href="{{route("expiry_list")}}">Expry List</a>
                        </li>
                        <li class="nav-item @if (Route::current()->getName() == "allUsers") active-top @endif">
                            <a class="nav-link" href="{{route("allUsers")}}">All Users</a>
                        </li>
                    @endif
                @endauth

                @guest
                    <li class="nav-item">
                        <a class="nav-link @if (Route::current()->getName() == "login") active-top @endif" href="{{ route('login') }}">{{ __('Login') }}</a>
                    </li>
                    @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link @if (Route::current()->getName() == "register") active-top @endif" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                    @endif
                    @else

                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link pb-md-0 dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class ="dropdown-item" href="{{route("userPage")}}">
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

        {{-- END TOP DROPDOWN MENU FOR MOBILE --}}


        {{-- MAIN SIDEBAR --}}
        <div class="auth-links ml-auto">
            <ul class="navbar-nav">
                <!-- Authentication Links -->
                @guest
                    <li class="nav-item">
                        <a class="nav-link mx-md-2 px-md-0 pb-md-0 @if (Route::current()->getName() == "login") active-top @endif" href="{{ route('login') }}">{{ __('Login') }}</a>
                    </li>
                    @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link mx-md-2 px-md-0 pb-md-0 @if (Route::current()->getName() == "register") active-top @endif" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                    @endif
                    @else

                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link pb-md-0 dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class ="dropdown-item" href="{{route("userPage")}}">
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
        <nav class="sidebar border-right d-none d-lg-block">
            <ul class="sidebar-group" >
                <li class="nav-item sidebar-item @if (Route::current()->getName() == "home") active @endif">
                    <a class="d-block sidebar-link text-decoration-none" href="{{route("home")}}">Home</a>
                </li>
                <li class="nav-item sidebar-item @if (Route::current()->getName() == "about") active @endif">
                    <a class="d-block sidebar-link text-decoration-none" href="{{route("about")}}">About</a>
                </li>
                @guest
                    <li class="nav-item sidebar-item @if (Route::current()->getName() == "login") active @endif">
                        <a class="d-block sidebar-link text-decoration-none" href="{{ route('login') }}">Login</a>
                    </li>
                    <li class="nav-item sidebar-item @if (Route::current()->getName() == "register") active @endif">
                        <a class="d-block sidebar-link text-decoration-none" href="{{ route('register') }}">Register</a>
                    </li>
                @endguest
            </ul>

            @if(Auth::check())
                <ul class="sidebar-group mt-3" >
                    <li class="nav-item sidebar-item @if (Route::current()->getName() == "rent") active @endif">
                        <a class="d-block sidebar-link text-decoration-none" href={{route('rent')}}>Rent a Locker</a>
                    </li>
                    <li class="nav-item sidebar-item @if (Route::current()->getName() == "userStatus") active @endif">
                        <a class="d-block sidebar-link text-decoration-none" href={{route('userStatus')}}>My Lockers</a>
                    </li>
                </ul>
            @endif

            @if(Auth::check() && Auth::user()->is_admin)
                <h5 class="text-center mt-4"> Admin Tools </h5>
                    <ul class="sidebar-group" >
                        <li class="nav-item sidebar-item @if (Route::current()->getName() == "adminDashboard") active @endif">
                            <a class="d-block sidebar-link text-decoration-none" href={{route('adminDashboard')}}>Dashboard</a>
                        </li>
                        <li class="nav-item sidebar-item @if (Route::current()->getName() == "allRentals") active @endif">
                            <a class="d-block sidebar-link text-decoration-none" href={{route('allRentals')}}>All Rentals</a>
                        </li>
                        <li class="nav-item sidebar-item @if (Route::current()->getName() == "pendingRentals") active @endif">
                            <a class="d-block sidebar-link text-decoration-none" href={{route('pendingRentals')}}>Pending Rentals</a>
                        </li>
                        <li class="nav-item sidebar-item @if (Route::current()->getName() == "expiry_list") active @endif">
                            <a class="d-block sidebar-link text-decoration-none" href={{route("expiry_list")}}>Expiry List</a>
                        </li>
                    </ul>

                    <ul class="sidebar-group" >
                        <li class="nav-item sidebar-item @if (Route::current()->getName() == "lockerIssues") active @endif">
                            <a class="d-block sidebar-link text-decoration-none" href={{route('lockerIssues')}}>Locker Issues</a>
                        </li>
                        <li class="nav-item sidebar-item @if (Route::current()->getName() == "adminLocations") active @endif">
                            <a class="d-block sidebar-link text-dark text-decoration-none" href={{route("adminLocations")}}>Manage Locations</a>
                        </li>
                        <li class="nav-item sidebar-item @if (Route::current()->getName() == "allUsers") active @endif">
                            <a class="d-block sidebar-link text-dark text-decoration-none" href={{route("allUsers")}}>Manage Users</a>
                        </li>
                        <li class="nav-item sidebar-item @if (Route::current()->getName() == "adminSettings") active @endif">
                            <a class="d-block sidebar-link text-dark text-decoration-none" href={{route("adminSettings")}}>Settings</a>
                        </li>
                    </ul>
            @endif
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
