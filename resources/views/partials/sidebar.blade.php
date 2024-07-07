<nav id="sidebar" class="navbar-dark">
    <div class="logo text-center" style="background-color: #f5f5f5">
        <a href="http://localhost:5174" class="nav-link text-uppercase overflow-hidden">
            <img class="img-fluid rounded-circle" src="/img/logo2.png" alt="logo" style="width: 100px">
        </a>
    </div>
    <div class="user">
        <div class="profile">
            <a class="nav-link d-flex align-items-center collapsed" href="#collapseExample" data-bs-toggle="collapse"
                aria-expanded="false">
                @auth
                    <img class="rounded-circle profile-picture me-2"
                        src="{{ Auth::user()->restaurant->logo ? asset('storage/' . Auth::user()->restaurant->logo) : '/img/user_placeholder.jpg' }}"
                        alt="{{ Auth::user()->name ? Auth::user()->name : 'Default' }} profile picture" >
                @else
                    <img class="rounded-circle profile-picture me-2" src="/img/user_placeholder.jpg"
                        alt="Default profile picture">
                @endauth
                <span>{{ Auth::user() ? Auth::user()->name : 'Ospite' }}</span>
                <i class="fa-solid fa-caret-down ms-auto"></i>
            </a>
            <div class="collapse" id="collapseExample">
                @if (Auth::user())
                    <ul class="navbar-nav">
                        {{-- <li class="nav-item">
                            <a class="nav-link d-flex align-items-center" href="{{ url('profile') }}">
                                <i class="fa-solid fa-user"></i> {{ __('Profilo') }}
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link d-flex align-items-center" href="#">
                                <i class="fa-solid fa-gear"></i> Impostazioni
                            </a>
                        </li> --}}
                        <li class="nav-item">
                            <a class="nav-link d-flex align-items-center" href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();">
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                                <i class="fa-solid fa-sign-out"></i> {{ __('Logout') }}
                            </a>
                        </li>
                    </ul>
                @else
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link d-flex align-items-center" href="{{ route('login') }}">
                                <i class="fa-solid fa-arrow-right-to-bracket"></i> {{ __('Login') }}
                            </a>
                        </li>
                        @if (Route::has('register'))
                            <li class="nav-item">
                                <a class="nav-link d-flex align-items-center" href="{{ route('register') }}">
                                    <i class="fa-solid fa-id-card"></i> Registrazione
                                </a>
                            </li>
                        @endif
                    </ul>
                @endif
            </div>
        </div>
    </div>
    @if (Auth::user())
    <ul id="routes-list" class="navbar-nav">
        <li>
            <a href="{{ route('admin.dashboard') }}" class="{{ Route::is('admin.dashboard') ? 'active' : '' }} nav-link d-flex align-items-center">
                <i class="fa-solid fa-house"></i> Dashboard
            </a>
        </li>
        <li>
            <a href="{{ route('admin.restaurants.index') }}" class="{{ Route::is('admin.restaurants.*') ? 'active' : '' }} nav-link d-flex align-items-center">
                <i class="fa-solid fa-shop"></i> Il mio ristorante
            </a>
        </li>
        <li>
            <a href="{{ route('admin.plates.index') }}" class="{{ Route::is('admin.plates.*') ? 'active' : '' }} nav-link d-flex align-items-center">
                <i class="fa-solid fa-utensils"></i> Piatti
            </a>
        </li>
        <li>
            <a href="{{ route('admin.orders.index') }}" class="{{ Route::is('admin.orders.*') ? 'active' : '' }} nav-link d-flex align-items-center">
                <i class="fa-solid fa-file-invoice"></i> Ordini
            </a>
        </li>
    </ul>
    
    @endif
</nav>
