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
    </ul>

</nav>