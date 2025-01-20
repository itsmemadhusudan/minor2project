@extends('dashboard.app')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Edit Order Status</h1>
</div>
    <div class="container">
        <div class="card">
            <div class="card-body">
                <p><strong>Order ID:</strong> #{{ $order->order_id }}</p>
                 <p><strong>User:</strong> {{ $order->user->name }} ({{ $order->user->email }})</p>
                  <p><strong>Total Amount:</strong> ${{ $order->total_amount }}</p>
                   <p><strong>Current Status:</strong> {{ $order->status }}</p>
                 <form action="{{ route('admin.orders.update', $order) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label for="status" class="form-label">Status</label>
                    <select name="status" id="status" class="form-control @error('status') is-invalid @enderror" required>
                        <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="processing" {{ $order->status == 'processing' ? 'selected' : '' }}>Processing</option>
                        <option value="completed" {{ $order->status == 'completed' ? 'selected' : '' }}>Completed</option>
                        <option value="cancelled" {{ $order->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                    </select>
                      @error('status')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                  </div>
                   <button type="submit" class="btn btn-primary">Update Status</button>
                   <a href="{{ route('admin.orders.index') }}" class="btn btn-secondary">Cancel</a>
                </form>

            </div>
        </div>
    </div>
@endsection