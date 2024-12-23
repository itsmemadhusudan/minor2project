<nav class="navbar navbar-expand-lg">
    <div class="container-fluid">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <a class="nav-link active" aria-current="page" href="{{ route('index') }}">
            <img src="{{ asset('assets/image/logo1.png') }}" alt="Yfasma"
                style="height: 40px; padding-top: 0; margin-top: 0;">
        </a>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" href="{{ route('index') }}" style="padding-bottom:0">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="{{ route('designer') }}" style="padding-bottom:0">Designer</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="{{ route('aboutus') }}" style="padding-bottom:0">About</a>
                </li>
                @if (Auth::check() && (Auth::user()->role == 'admin' || Auth::user()->role == 'designer'))
                    <li class="nav-item">
                        {{-- <a class="nav-link active" href="{{ route('uploads.create') }}" >Upload</a> --}}
                        <a class="nav-link active" href="{{ route('add_image') }}">Upload</a>
                    </li>
                @endif
                <!-- Other menu items -->
            </ul>
            <form class="col-12 col-lg-auto mb-3 mb-lg-0 me-lg-3" action="{{ route('search') }}" method="GET">
                <div id="the-basics">
                    <div class="input-group">
                        <input name="searchField" id="searchField" type="search"
                            class="form-control form-control-dark" style="width: 426px;">
                        <button class="btn btn-outline-secondary" type="submit" id="button-addon2">Search</button>
                    </div>
                </div>
            </form>
            <a href="{{ route('cart') }}" class="me-2">
                <img src="{{ asset('assets/image/cart.png') }}" alt="Cart"
                    style="height: 25px; padding-top: 0; margin-top: 0;">
            </a>
            @guest
                <button class="signin" type="button">
                    <a href="{{ route('login.form') }}" style="text-decoration: none; color: white;">Login</a>
                </button>
            @else
                <button class="signin" type="button">
                    <a href="{{ route('logout') }}" style="text-decoration: none; color: white;">Logout</a>
                </button>
            @endguest
        </div>
    </div>
</nav>
