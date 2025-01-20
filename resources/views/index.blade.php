@extends('master')

@section('content')
    <div class="container">

        <!-- Carousel -->
        <div id="carouselExampleAutoplaying" class="carousel slide mb-5" data-bs-ride="carousel">
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

        <!-- Product Listing -->
        <div class="row">
            @foreach ($products as $product)
                <div class="col-md-4 mb-4">
                    <div class="card h-100 product-card">
                       @if($product->image)
                             <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="card-img-top product-image">
                         @else
                             <img src="{{asset('assets/image/carousel3.png')}}" alt="placeholder image" class="card-img-top product-image">
                        @endif
                        <div class="card-body">
                            <h5 class="card-title product-name">{{ $product->name }}</h5>
                            <p class="card-text product-price">${{ $product->price }}</p>
                            <a href="{{ route('view_product', encrypt($product->id)) }}" class="btn btn-primary add-to-cart-btn">View</a>
                            
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection