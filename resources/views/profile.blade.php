<!DOCTYPE html>
<html>
    <head>
        <title>profile</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">
        <style>
            .profile-image {
                width: 200px;
                height: 200px;
                border-radius: 50%;
                object-fit: cover;
            }
            .profile-info {
                margin-top: 20px;
            }
            .profile-info h2 {
                margin-bottom: 10px;
            }
            .profile-info p {
                margin-bottom: 20px;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <h1>Profile</h1>

            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <form action="{{ route('profile.update') }}" method="POST">
                @csrf

                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}" required>
                </div>

                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" id="email" name="email" value="{{ $user->email }}" required>
                </div>

                <div class="form-group">
                    <label for="address">Address</label>
                    <input type="text" class="form-control" id="address" name="address" value="{{ $user->address }}">
                </div>

                <button type="submit" class="btn btn-primary">Update Profile</button>
            </form>
        </div>
    @endsection
    dashboard.blade.php:

    php
    Copy code
    <!-- resources/views/dashboard.blade.php -->
    @extends('layouts.app')

    @section('content')
        <div class="container">
            <h1>Dashboard</h1>
            <p>Welcome to your dashboard, {{ Auth::user()->name }}!</p>
            <!-- Add more dashboard content as necessary -->
        </div>
    </body>
</html>
