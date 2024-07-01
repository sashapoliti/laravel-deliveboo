<nav id="sidebar" class="navbar-dark">
    <div class="logo text-center">
        <a href="http://localhost:5174" class="nav-link text-uppercase">
            <img class="img-fluid " src="../img/logo-nobg.png" alt="logo" style="width: 100px">
        </a>
    </div>
    <div class="user">
        <div class="profile">
            <a class="nav-link d-flex align-items-center collapsed" href="#collapseExample" data-bs-toggle="collapse"
                aria-expanded="false">
                <img class="rounded-circle profile-picture me-2"
                    src="{{ Auth::user() ? 'https://media-assets.lacucinaitaliana.it/photos/61fa9709f0adc010b7251d76/16:9/w_2560%2Cc_limit/ristoranti-friuli.jpg' : '../img/user_placeholder.jpg' }}"
                    alt="{{ Auth::user() ? Auth::user()->name : 'Default' }} profile picture">
                <span>{{ Auth::user() ? Auth::user()->name : 'Guest' }}</span>
                <i class="fa-solid fa-caret-down ms-auto"></i>
            </a>
            <div class="collapse" id="collapseExample">
                @if (Auth::user())
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link d-flex align-items-center" href="{{ url('profile') }}">
                            <i class="fa-solid fa-user"></i> {{ __('Profile') }}
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link d-flex align-items-center" href="#">
                            <i class="fa-solid fa-gear"></i> Settings
                        </a>
                    </li>
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
                                <i class="fa-solid fa-id-card"></i> {{ __('Register') }}
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
        @if($restaurants->count() > 0)
            <li>
                <a href="{{ route('admin.restaurants.index') }}" class="{{ Route::is('admin.restaurants.*') ? 'active' : '' }} nav-link d-flex align-items-center">
                    <i class="fa-solid fa-shop"></i> My Restaurant
                </a>
            </li>
            <li>
                <a href="{{ route('admin.plates.index') }}" class="{{ Route::is('admin.plates.*') ? 'active' : '' }} nav-link d-flex align-items-center">
                    <i class="fa-solid fa-utensils"></i> Plates
                </a>
            </li>
        @endif
     
      
        {{-- <li>
            <a href="{{ route('admin.movie_rooms.index') }}" class="{{ Route::is('admin.movie_rooms.*') ? 'active' : '' }} nav-link d-flex align-items-center">
                <i class="fa-solid fa-video"></i> Projections
            </a>
        </li> --}}
        {{-- <li>
            <a href="{{ route('admin.slots.index') }}" class="{{ Route::is('admin.slots.*') ? 'active' : '' }} nav-link d-flex align-items-center">
                <i class="fa-solid fa-clock"></i> Programmations
            </a>
        </li> --}}
    </ul>
    @endif
</nav>