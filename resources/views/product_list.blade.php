@extends('master')
@section('content')
<div class="row g-4 my-4">

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
@endsection
