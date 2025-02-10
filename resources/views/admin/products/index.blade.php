@extends('dashboard.app')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Product Management</h1>
</div>
    <div class="container">
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        {{-- <a href="{{ route('admin.products.create') }}" class="btn btn-primary mb-3">Create New Product</a> --}}
        @if (Auth::check() && (Auth::user()->role == 'admin' || Auth::user()->role == 'designer'))
    <a href="{{ route('admin.products.create') }}" class="btn btn-primary mb-3">Create New Product</a>
@endif
        <table class="table">
            <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Price</th>
                <th>Category</th>
                <th>Added By</th>
                <th>Image</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach($products as $product)
                <tr>
                    <td>{{ $product->id }}</td>
                    <td>{{ $product->name }}</td>
                    <td>NRP {{ $product->price }}</td>
                    <td>{{ $product->category }}</td>
                    <td>{{ $product->user->name }}</td>
                    <td>
                         @if($product->image)
                                <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" style="max-height: 50px;">
                         @else
                            <span>No Image</span>
                         @endif
                    </td>
                    <td>
                         {{-- <a href="{{ route('admin.products.show', $product) }}" class="btn btn-sm btn-info">View</a> --}}
                        <a href="{{ route('admin.products.edit', $product) }}" class="btn btn-sm btn-primary">Edit</a>
                        <form action="{{ route('admin.products.destroy', $product) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this product?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
