@extends('dashboard.app')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Order Details</h1>
</div>
<div class="container">
    <div class="card mb-4 shadow">
        <div class="card-header">
            Order Information
        </div>
        <div class="card-body">
            <p><strong>Order ID:</strong> #{{ $order->order_id }}</p>
            <p><strong>User:</strong> {{ $order->user->name }} ({{ $order->user->email }})</p>
            <p><strong>Total Amount:</strong> NRP {{ $order->total_amount }}</p>
            <p><strong>Status:</strong> {{ $order->status }}</p>
            <p><strong>Payment Type:</strong> {{ $order->payment_type }}</p>
            <p><strong>Payment Status:</strong> {{ $order->payment_status }}</p>
        </div>
    </div>

    <div class="card shadow">
        <div class="card-header">
            Products
        </div>
        <div class="card-body">
            @if($carts->isNotEmpty())
                <ul class="list-group">
                    @foreach($carts as $cart)
                        <li class="list-group-item">
                            <p class="mb-0"><strong>Name: </strong>{{ $cart->product->name }}</p>
                            <p class="mb-0"><strong>Price: </strong>${{ $cart->product->price }}</p>
                            <p class="mb-0"><strong>Quantity:</strong> {{ $cart->quantity }}</p> <!-- Corrected property -->
                        </li>
                    @endforeach
                </ul>
            @else
                <p>No cart items found for this order.</p>
            @endif
        </div>
    </div>
    <a href="{{ route('admin.orders.index') }}" class="btn btn-secondary mt-3">Back to Orders</a>
</div>
@endsection
