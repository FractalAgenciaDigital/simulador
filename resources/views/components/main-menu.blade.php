<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-primary justify-content-between">
    <a class="navbar-brand" href="#">
        <img src="{{ asset('img/logo.jpg') }}" alt="" srcset="" width="100">
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText"
        aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <ul class="nav justify-content-end">

        @if (Route::has('login'))
        <li class="nav-item">
            @auth
            <a href="{{ url('/home') }}" class="nav-link text-sm text-white">Home</a>
            @else
            <a href="{{ route('login') }}" class="nav-link text-sm text-white">Log in</a>
        </li>
        <li class="nav-item">
            @if (Route::has('register'))
            <a href="{{ route('register') }}" class="nav-link text-sm text-white">Register</a>
            @endif
            @endauth
        </li>
        @endif
        {{-- @guest
        @if (Route::has('login'))
        <li class="nav-item">
            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
        </li>
        @endif

        @if (Route::has('register'))
        <li class="nav-item">
            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
        </li>
        @endif
        @else
        <li class="nav-item dropdown">
            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false" v-pre>
                {{ Auth::user()->nombres }}
            </a>

            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                     document.getElementById('logout-form').submit();">
                    {{ __('Logout') }}
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </div>
        </li>
        @endguest --}}
    </ul>

</nav>