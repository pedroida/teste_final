<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/meucss.css') }}" rel="stylesheet">
    
</head>
<body>
    <div id="app">
        <nav id="nav-sup" class="navbar navbar-default navbar-static-top">
            <div class="container">
                <div class="navbar-header">

                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse" aria-expanded="false">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <!-- Branding Image -->
                    @guest
                    <a class="navbar-brand" href="{{ url('/login') }}"><img id="indexImage" src="{{ URL::asset('images/logo.png') }}"></a>
                    @endguest
                    @auth
                    <a class="navbar-brand" href="{{ url('/index') }}"><img id="indexImage" src="{{ URL::asset('images/logo.png') }}"></a>
                    @endauth
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav">
                        &nbsp;
                        @auth
                        <li class="navLink"><a href="{{ route('cadastrar') }}" role="button" >Adicionar produto</a></li>

                        <li class="navSearch">
                            <form class="form-inline" method="GET" action="{{ route('buscar')}}">
                               
                            <div class="form-group mx-sm-3 mb-2">
                                <input type="text" class="form-control" id="search" name="search"  placeholder="O que procura..." required>
                            </div>
                            <button type="submit" class="btn btn-info mb-2">Buscar</button>
                        </form>
                    </li>
                    @endauth
                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="nav navbar-nav navbar-right">
                    <!-- Authentication Links -->
                    @guest
                    <li class="navLink"><a href="{{ route('login') }}">Entrar</a></li>
                    <li class="navLink"><a href="{{ route('register') }}">Registrar</a></li>
                    @else
                    <li class="dropdown navLink">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true">
                            {{ Auth::user()->name }} <span class="caret"></span>
                        </a>

                        <ul class="dropdown-menu">
                            <li class="navLink">
                                <a href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
                                Sair
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                {{ csrf_field() }}
                            </form>
                        </li>
                    </ul>
                </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>
@yield('content')
<div id="cont-footer" class="container">
 <div id="footer">
    <p class="text-muted credit"><span style="text-align: center; float: left">&copy; 2017 <a href="#">Pedro Ida</a></span> <span class="hidden-phone"
        style="text-align: right; float: right">Powered by: <a
        href="http://laravel.com/" alt="Laravel 5.1">Laravel 5.5</a></span></p>
    </div>
</div>
</div>


<!-- Scripts -->
<script src="{{ asset('js/app.js') }}"></script>
<script src="{{ asset('js/meujs.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-maskmoney/3.0.2/jquery.maskMoney.min.js" type="text/javascript"></script>

</body>

</html>


