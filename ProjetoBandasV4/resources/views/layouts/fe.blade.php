<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>TC-Bands</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="{{asset('css/style.css')}}">

</head>
<body>

<header>
    <nav class="navbar navbar-expand-lg bg-warning">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ route('home') }}"><img src="{{asset('img/logo.png')}}" alt="" width="150"></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="{{ route('home') }}">Home</a>
                    </li>
                    @Auth
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                               aria-expanded="false">
                                Settings
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="{{ route('all.bands') }}">Manage Bands</a></li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                @if (Auth::user()->user_type == App\Models\User::TYPE_ADMIN)
                                    <li><a class="dropdown-item" href="{{ route('music.add-music') }}">Add Music</a>
                                    </li>
                                    <li><a class="dropdown-item" href="{{ route('album.add') }}">Add Album</a></li>
                                @endif
                            </ul>
                        </li>
                    @endauth
                </ul>
                <form class="d-flex" action="{{ route('search') }}" method="GET" role="search">
                    <input class="form-control me-1" type="search" name="query"
                           placeholder="Search by Band, Album or Music" aria-label="Search">
                    <button class="btn btn-outline-light" type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
                </form>
                <ul class="navbar-nav ml-auto">
                    @guest
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">Login</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">Register</a>
                        </li>
                    @else
                        <li class="nav-item d-flex align-items-center">
                            <span class="nav-link">Hello, {{ Auth::user()->name }}</span>
                            <a class="nav-link" href="{{ route('user.dashboard') }}">
                                <i class="fas fa-user-circle fa-lg"></i>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                         document.getElementById('logout-form').submit();">
                                Logout
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>
</header>
<main>
    @yield('content')
</main>

<footer class="py-3 my-4 shadow bg-dark">
    <ul class="nav justify-content-center border-bottom pb-3 mb-3">
        <li class="nav-item"><a href="#" class="nav-link px-2 text-white">Home</a></li>
        <li class="nav-item"><a href="#" class="nav-link px-2 text-white">Features</a></li>
        <li class="nav-item"><a href="#" class="nav-link px-2 text-white">Pricing</a></li>
        <li class="nav-item"><a href="#" class="nav-link px-2 text-white">FAQs</a></li>
        <li class="nav-item"><a href="#" class="nav-link px-2 text-white">About</a></li>
    </ul>
    <p class="text-center text-white">&copy; 2024 TC-Bands, Inc</p>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
<script src="https://kit.fontawesome.com/fab16d30b8.js" crossorigin="anonymous"></script>
<script src="{{ asset('js/main.js') }}"></script>
</body>
</html>
