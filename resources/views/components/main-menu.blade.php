<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-light bg-light justify-content-between">
    <a class="navbar-brand" href="#">Navbar w/ text</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText"
        aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <ul class="nav justify-content-end">

        @if (Route::has('login'))
        <li class="nav-item">
            @auth
            <a href="{{ url('/home') }}" class="nav-link text-sm text-gray-700">Home</a>
            @else
            <a href="{{ route('login') }}" class="nav-link text-sm text-gray-700">Log in</a>
        </li>
        <li class="nav-item">
            @if (Route::has('register'))
            <a href="{{ route('register') }}" class="nav-link text-sm text-gray-700">Register</a>
            @endif
            @endauth
        </li>
        @endif
    </ul>

</nav>