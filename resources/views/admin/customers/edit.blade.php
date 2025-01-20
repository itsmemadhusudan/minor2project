@extends('dashboard.app')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Edit Customer</h1>
</div>
<div class="container">
    <form action="{{ route('admin.customers.update', $customer) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $customer->name) }}" required>
             @error('name')
              <div class="invalid-feedback">{{ $message }}</div>
             @enderror
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email', $customer->email) }}" required>
             @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
             @enderror
        </div>
          <div class="mb-3">
             <label for="password" class="form-label">Password</label>
             <input type="password" name="password" id="password" class="form-control @error('password') is-invalid @enderror">
              @error('password')
                  <div class="invalid-feedback">{{ $message }}</div>
              @enderror
         </div>
          <div class="mb-3">
                <label for="password_confirmation" class="form-label">Confirm Password</label>
                 <input type="password" name="password_confirmation" id="password_confirmation" class="form-control">
         </div>
         <div class="mb-3">
              <label for="phone" class="form-label">Phone</label>
             <input type="text" name="phone" id="phone" class="form-control @error('phone') is-invalid @enderror" value="{{ old('phone', $customer->phone) }}">
              @error('phone')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
         </div>
        <button type="submit" class="btn btn-primary">Update Customer</button>
        <a href="{{ route('admin.customers.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection