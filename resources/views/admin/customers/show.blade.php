@extends('dashboard.app')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Edit Customer Details</h1>
</div>
    <div class="container">

        <div class="card">
            <div class="card-body">
                 <h5 class="card-title">Name: {{ $customer->name }}</h5>
                <p class="card-text"><strong>Email:</strong> {{ $customer->email }}</p>
                 <p class="card-text"><strong>Phone:</strong> {{ $customer->phone }}</p>
                <a href="{{ route('admin.customers.edit', $customer) }}" class="btn btn-primary">Edit Customer</a>
                <a href="{{ route('admin.customers.index') }}" class="btn btn-secondary">Back to Customer List</a>
            </div>
        </div>
    </div>
@endsection