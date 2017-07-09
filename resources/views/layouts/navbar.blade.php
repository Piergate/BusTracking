<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">

            <!-- Collapsed Hamburger -->
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                <span class="sr-only">Toggle Navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>

            <!-- Branding Image -->
            <a class="navbar-brand" href="{{ url('/') }}" style="font-family: 'Kumar One', cursive;">
                {{ config('app.name', 'Laravel') }}
            </a>
        </div>

        <div class="collapse navbar-collapse" id="app-navbar-collapse">
            <!-- Left Side Of Navbar -->
            <ul class="nav navbar-nav">
                @if (Auth::check())
                    <li><a href="{{ url('/lines') }}"><i class="fa fa-location-arrow"></i> Lines</a></li>
                    <li><a href="{{ url('/buses') }}"><i class="fa fa-bus"></i> Buses</a></li>
                    @if(Entrust::hasRole('Admin'))
                        <li><a href="{{ url('/drivers') }}"><i class="fa fa-drivers-license-o"></i> Drivers</a></li>
                        <li><a href="{{ url('/supervisors') }}"><i class="fa fa-user-circle-o"></i> Supervisors</a></li>
                        <li><a href="{{ url('/students') }}"><i class="fa fa-users"></i> Students</a></li>
                        <li><a href=""><i class="fa fa-support"></i> Help</a></li>
                    @endif
                    {{--@if(Entrust::hasRole('Parent'))--}}
                        <li><a href="{{ url('/locatemybus') }}"><i class="fa fa-map-marker"></i> Locate my bus</a></li>
                    {{--@endif--}}
                @endif
            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="nav navbar-nav navbar-right">
                <!-- Authentication Links -->
                @if (Auth::guest())
                    <li><a href="{{ route('login') }}"><i class="fa fa-sign-in"></i> Login</a></li>
                    <li><a href="{{ route('register') }}"><i class="fa fa-arrow-up"></i> Register</a></li>
                @else
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                            <i class="fa fa-user"></i> {{ Auth::user()->name }} <span class="caret"></span>
                        </a>

                        <ul class="dropdown-menu" role="menu">
                            <li>
                                <a href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();">
                                    <i class="fa fa-sign-out"></i> Logout
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                            </li>
                        </ul>
                    </li>
                @endif
            </ul>
        </div>
    </div>
</nav>