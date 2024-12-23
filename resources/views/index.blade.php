@extends('master')

@section('content')
    <main>
        @auth
            <p class="mt-4 text-center" style="font-size: 24px; font-weight: bold; font-style: italic;">Welcome,
                {{ Auth::user()->name }}!</p>
        @else
            <p class="mt-4 text-center" style="font-size: 24px;"><b><i>Welcome to the home page! Please log in to see
                        personalized content.</i></b></p>
        @endauth

        @if (session('success'))
    <div class="toast-container position-fixed top-0 end-0 p-3" style="z-index: 9999;">
        <div id="successToast" class="toast align-items-center text-bg-success border-0" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="d-flex">
                <div class="toast-body">
                    {{ session('success') }}
                </div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
        </div>
    </div>

    <!-- Toast JavaScript -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var toastEl = document.getElementById('successToast');
            var toast = new bootstrap.Toast(toastEl);
            toast.show();
        });
    </script>
@endif

        <div id="carouselExampleAutoplaying" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active" data-bs-interval="2000">
                    <img src="{{ asset('assets/image/carousel1.png') }}" class="d-block w-100" alt="First Slide">
                </div>
                <div class="carousel-item" data-bs-interval="2000">
                    <img src="{{ asset('assets/image/carousel2.png') }}" class="d-block w-100" alt="Second Slide">
                </div>
                <div class="carousel-item" data-bs-interval="2000">
                    <img src="{{ asset('assets/image/carousel3.png') }}" class="d-block w-100" alt="Third slide">
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleAutoplaying"
                data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleAutoplaying"
                data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>

        <div class="empty"></div>
        <div class="row g-4">

            @foreach ($uploads as $item)
                <div class="col-lg-3 col-md-6">
                    <a href="{{ route('view_product', encrypt($item->id)) }}">
                        <div class="card h-100 custom-card">
                            <img src="{{ asset('storage/' . $item->profile_picture) }}" class="card-img-top"
                                alt="Western Dress">

                            <div class="card-bottom-overlay">
                                <p class="card-text">{{ $item->designer_name }}<br />{{ $item->description }}</p>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach

            {{-- <div class="col-lg-3 col-md-6">
            <div class="card h-100 custom-card">
                <a href="popup.html">
                    <img src="{{ asset('assets/image/men1.png') }}" class="card-img-top" alt="Men's Wear">
                </a>
                <div class="card-bottom-overlay">
                    <p class="card-text">Manish Malhotra<br/>Lehenga</p>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="card h-100 custom-card">
                <a href="popup.html">
                    <img src="{{ asset('assets/image/men2.png') }}" class="card-img-top" alt="Men's Wear">
                </a>
                <div class="card-bottom-overlay">
                    <p class="card-text">Manish Malhotra<br/>Lehenga</p>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="card h-100 custom-card">
                <a href="popup.html">
                    <img src="{{ asset('assets/image/men3.png') }}" class="card-img-top" alt="Men's Wear">
                </a>
                <div class="card-bottom-overlay">
                    <p class="card-text">Manish Malhotra<br/>Lehenga</p>
                </div>
            </div>
        </div> --}}
        </div>
        <div class="emptytwo"></div>
    </main>
@endsection
