@extends('dashboard.app')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Product Details</h1>
</div>
    <div class="container">
        <div class="card">
            <div class="card-body">
                 <h5 class="card-title">Name: {{ $product->name }}</h5>
                  <p class="card-text"><strong>Description:</strong> {{ $product->description }}</p>
                 <p class="card-text"><strong>Price:</strong> NRP {{ $product->price }}</p>
                <p class="card-text"><strong>Category:</strong> {{ $product->category->name }}</p>
                 <p class="card-text"><strong>Added By:</strong> {{ $product->user->name }}</p>
                    @if($product->image)
                            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" style="max-height: 200px; margin-top: 10px;">
                   @else
                            <span>No Image</span>
                   @endif
<br>
                <a href="{{ route('admin.products.edit', $product) }}" class="btn btn-primary">Edit Product</a>
                <a href="{{ route('admin.products.index') }}" class="btn btn-secondary">Back to Product List</a>
            </div>
        </div>
    </div>
@endsection