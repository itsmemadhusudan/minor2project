@extends('master')

@section('content')
<div class="container my-5">
    <h2 class="mb-4">You can edit and delete the info.</h2>
    <div class="row">
        <div class="col-md-12">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h5 class="card-title mb-4">Designer Management</h5>
                    <table class="table table-hover table-bordered">
                        <thead class="thead-dark">
                            <tr>
                                {{-- <th scope="col">ID</th> --}}
                                <th scope="col">Product Name</th>
                                <th scope="col">Email</th>
                                <th scope="col">Description</th>
                                <th scope="col">Price</th>
                                <th scope="col">Category</th>
                                <th scope="col">Profile Picture</th>
                                <th scope="col">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($uploads as $upload)
                            <tr>
                                {{-- <th scope="row">{{ $upload->id }}</th> --}}
                                <td>{{ $upload->designer_name }}</td>
                                <td>{{ $upload->email }}</td>
                                <td>{{ $upload->description }}</td>
                                <td>${{ $upload->price }}</td>
                                <td>{{ $upload->category }}</td>
                                <td>
                                    <img src="{{ asset('storage/' . $upload->profile_picture) }}" alt="{{ $upload->designer_name }}" class="img-fluid" style="width: 100px; height: auto;">
                                </td>
                                <td>
                                    <a href="{{ route('admin.edit', $upload->id) }}" class="btn btn-sm btn-dark">Edit</a>
                                    <form action="{{ route('admin.destroy', $upload->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<style>
/* Custom styles for the table */
.table th, .table td {
    vertical-align: middle;
}

.table-hover tbody tr:hover {
    background-color: #f1f1f1;
}

.table-bordered th, .table-bordered td {
    border: 1px solid #dee2e6;
}

.card {
    border-radius: 8px;
}

.card-body {
    padding: 1.5rem;
}

.img-fluid {
    max-width: 100%;
    height: auto;
}
</style>

@endsection
