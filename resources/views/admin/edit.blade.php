{{-- edit for admin controller page --}}
@extends('master')

@section('content')
<div class="container my-5">
    <h2>Edit Designer</h2>
    <form action="{{ route('admin.update', $upload->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="designer_name" class="form-label">Designer Name</label>
            <input type="text" class="form-control" id="designer_name" name="designer_name" value="{{ $upload->designer_name }}" required>
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" value="{{ $upload->email }}" required>
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea class="form-control" id="description" name="description">{{ $upload->description }}</textarea>
        </div>

        <div class="mb-3">
            <label for="price" class="form-label">Price</label>
            <input type="number" step="0.01" class="form-control" id="price" name="price" value="{{ $upload->price }}" required>
        </div>

        <div class="mb-3">
            <label for="category" class="form-label">Category</label>
            <input type="text" class="form-control" id="category" name="category" value="{{ $upload->category }}" required>
        </div>

        <div class="mb-3">
            <label for="profile_picture" class="form-label">Profile Picture</label>
            <input type="file" class="form-control" id="profile_picture" name="profile_picture">
            @if($upload->profile_picture)
                <img src="{{ asset('storage/' . $upload->profile_picture) }}" alt="{{ $upload->designer_name }}" style="width: 100px; height: auto;">
            @endif
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
@endsection

