@extends('dashboard.app')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">User Details</h1>
</div>
    <div class="container">

        <div class="card">
            <div class="card-body">
                 <h5 class="card-title">Name: {{ $user->name }}</h5>
                <p class="card-text"><strong>Email:</strong> {{ $user->email }}</p>
                 <p class="card-text"><strong>Phone:</strong> {{ $user->phone }}</p>
                 <p class="card-text"><strong>Role:</strong> {{ $user->role }}</p>
                <a href="{{ route('admin.users.edit', $user) }}" class="btn btn-primary">Edit User</a>
                <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">Back to User List</a>
            </div>
        </div>
    </div>
@endsection