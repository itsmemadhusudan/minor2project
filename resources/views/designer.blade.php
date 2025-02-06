<!-- designer.blade.php -->
@extends('master')

@push('styles')
<style>
    .sidebar {
        background-color: #f8f9fa;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        color: black;
    }

    .sidebar-sticky {
        position: sticky;
        top: 20px;
    }

    .filter-option {
        display: block;
        padding: 10px 15px;
        margin-bottom: 5px;
        border-radius: 5px;
        color: #495057;
        text-decoration: none;
        transition: all 0.3s ease;
    }

    .filter-option:hover {
        background-color: #e9ecef;
        text-decoration: none;
    }

    .filter-option.active {
        background-color: #0d6efd;
        color: white;
    }

    .product-card {
        border: none;
        border-radius: 8px;
        transition: all 0.3s ease;
        height: 100%;
    }

    .product-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 4px 15px rgba(0,0,0,0.1);
    }

    .product-image {
        height: 200px;
        object-fit: cover;
        border-radius: 8px 8px 0 0;
    }

    .product-category {
        color: #6c757d;
        font-size: 0.9rem;
    }

    .product-price {
        color: #0d6efd;
        font-weight: bold;
        font-size: 1.1rem;
    }

    .section-title {
        font-size: 1.2rem;
        font-weight: 600;
        margin-bottom: 15px;
        color: #212529;
    }

    .filter-section {
        margin-bottom: 25px;
    }

    .empty-state {
        padding: 40px;
        text-align: center;
        background-color: #f8f9fa;
        border-radius: 8px;
        margin-top: 20px;
    }
</style>
@endpush

@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <!-- Left Sidebar -->
        <div class="col-md-3 col-lg-2">
            <div class="sidebar sidebar-sticky">
                <h2 class="section-title">Filters</h2>

                <!-- Price Range Filter -->
                <div class="filter-section">
                    <h3 class="section-title">Price Range</h3>
                    <a href="{{ route('designer', ['price_range' => 'under1000', 'sort' => $currentSort, 'category' => $currentCategory]) }}"
                       class="filter-option {{ $currentPriceRange === 'under1000' ? 'active' : '' }}" >
                        Under NPR 1000
                    </a><br>
                    <a href="{{ route('designer', ['price_range' => 'under2000', 'sort' => $currentSort, 'category' => $currentCategory]) }}"
                       class="filter-option {{ $currentPriceRange === 'under2000' ? 'active' : '' }}">
                        NPR 1000 - NPR 2000
                    </a><br>
                    <a href="{{ route('designer', ['price_range' => 'above2000', 'sort' => $currentSort, 'category' => $currentCategory]) }}"
                       class="filter-option {{ $currentPriceRange === 'above2000' ? 'active' : '' }}">
                        Above NPR 2000
                    </a>
                </div>

                <!-- Category Filter -->
                <div class="filter-section">
                    <h3 class="section-title">Categories</h3>
                    <a href="{{ route('designer', ['category' => 'all', 'sort' => $currentSort, 'price_range' => $currentPriceRange]) }}"
                       class="filter-option {{ $currentCategory === 'all' ? 'active' : '' }}">
                        All Categories
                    </a><br>
                    <a href="{{ route('designer', ['category' => 'Western', 'sort' => $currentSort, 'price_range' => $currentPriceRange]) }}"
                       class="filter-option {{ $currentCategory === 'Western' ? 'active' : '' }}">
                        Western
                    </a><br>
                    <a href="{{ route('designer', ['category' => 'Traditional', 'sort' => $currentSort, 'price_range' => $currentPriceRange]) }}"
                       class="filter-option {{ $currentCategory === 'Traditional' ? 'active' : '' }}">
                        Traditional
                    </a>
                </div>

                <!-- Sort Options -->
                <div class="filter-section">
                    <h3 class="section-title">Sort By</h3>
                    <a href="{{ route('designer', ['sort' => 'name', 'direction' => $currentSort === 'name' && $currentDirection === 'asc' ? 'desc' : 'asc', 'category' => $currentCategory, 'price_range' => $currentPriceRange]) }}"
                       class="filter-option {{ $currentSort === 'name' ? 'active' : '' }}">
                        Name
                        @if($currentSort === 'name')
                            <i class="fas fa-arrow-{{ $currentDirection === 'asc' ? 'up' : 'down' }} float-end"></i>
                        @endif
                    </a><br>
                    <a href="{{ route('designer', ['sort' => 'price', 'direction' => $currentSort === 'price' && $currentDirection === 'asc' ? 'desc' : 'asc', 'category' => $currentCategory, 'price_range' => $currentPriceRange]) }}"
                       class="filter-option {{ $currentSort === 'price' ? 'active' : '' }}">
                        Price
                        @if($currentSort === 'price')
                            <i class="fas fa-arrow-{{ $currentDirection === 'asc' ? 'up' : 'down' }} float-end"></i>
                        @endif
                    </a><br>
                    <a href="{{ route('designer', ['sort' => 'category', 'direction' => $currentSort === 'category' && $currentDirection === 'asc' ? 'desc' : 'asc', 'category' => $currentCategory, 'price_range' => $currentPriceRange]) }}"
                       class="filter-option {{ $currentSort === 'category' ? 'active' : '' }}">
                        Category
                        @if($currentSort === 'category')
                            <i class="fas fa-arrow-{{ $currentDirection === 'asc' ? 'up' : 'down' }} float-end"></i>
                        @endif
                    </a>
                </div>
            </div>
        </div>

        <!-- Right Content Area -->
        <div class="col-md-9 col-lg-10">
            <div class="row ">
                @forelse($products as $product)
                <div class="col-md-4 mb-4">
                    <div class="card h-100 product-card">
                       @if($product['image'])
                             <img src="{{ asset('storage/' . $product['image']) }}" alt="{{ $product['name'] }}" class="card-img-top product-image">
                         @else
                             <img src="{{asset('assets/image/carousel3.png')}}" alt="placeholder image" class="card-img-top product-image">
                        @endif
                        <div class="card-body">
                            <h5 class="card-title product-name">{{ $product['name'] }}</h5>
                            <p class="card-text product-price">${{ $product['price'] }}</p>
                            <a href="{{ route('view_product', encrypt($product['id'])) }}" class="btn btn-primary add-to-cart-btn" style="background-color:#bce9f4;color:black;">View</a>

                        </div>
                    </div>
                </div>
                @empty
                    <div class="col-12">
                        <div class="empty-state">
                            <p class="text-muted mb-0">No products found matching your criteria.</p>
                        </div>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection
