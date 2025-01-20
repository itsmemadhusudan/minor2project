<nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm">
    <div class="container">
        <a class="navbar-brand" href="{{ route('index') }}">
            <img src="{{ asset('assets/image/logo1.png') }}" alt="Yfasma" class="navbar-logo">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('index') }}">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('designer') }}">Product</a>
                </li>

            </ul>
            <form class="d-flex me-3" action="{{ route('search') }}" method="GET">
                <div class="input-group">
                   <input name="searchField" id="searchField" type="search" class="form-control" placeholder="Search Products">
                   <button class="btn btn-outline-secondary" type="submit">Search</button>
                </div>
            </form>
                <a href="{{ route('cart') }}" class="me-2 nav-icon">
                    <img src="{{ asset('assets/image/cart.png') }}" alt="Cart" style="height: 25px">
                </a>
            @guest
                 <button class="btn btn-primary ms-2"><a href="{{ route('login.form') }}" style="text-decoration: none; color: white;">Login</a></button>
            @else
            {{-- <div class="user_icons">
                <span>{{ Auth::user()->name }}</span>
                <a href="{{ route('admin.profile') }}">
                    <img src="{{ asset('assets/image/user.png') }}" alt="User" style="height: 35px; cursor:pointer">
                  </a>
            </div> --}}
            <div class="user_icons">
                <span>{{ Auth::user()->name }}</span>

                @if (Auth::user()->role == 'admin' || Auth::user()->role == 'designer')
                    <!-- Link for admin and designer -->
                    <a href="{{ route('admin.profile') }}">
                        <img src="{{ asset('assets/image/user.png') }}" alt="User" style="height: 35px; cursor:pointer">
                    </a>
                @else
                    <!-- Disabled for user role -->
                    <img src="{{ asset('assets/image/user.png') }}" alt="User" style="height: 35px; cursor:not-allowed; opacity: 0.5">
                @endif
            </div>
            @endguest
            @if (Auth::check() && Auth::user()->role == 'user')
    <a href="{{ route('logout') }}" style="color: black">Logout</a>
@endif
        </div>
    </div>
</nav>
