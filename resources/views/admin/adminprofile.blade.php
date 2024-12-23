@extends('master')
@section('content')
    <!-- Admin Panel -->
    <div class="container my-5">

      <div class="row">
        <div class="col-md-3">
          <div class="card text-white bg-primary">
            <div class="card-body">
              <h5 class="card-title">Total Users:
                    {{-- @foreach($userDetails as $userDetail)
                            {{ $loop->iteration }}
                            {{ $totalUsers->id }} --}}
              </h5>
              {{-- <p class="card-text">{{ $totalUsers }}</p> --}}
            </div>
          </div>
        </div>
        {{-- <div class="col-md-3">
          <div class="card text-white bg-success">
            <div class="card-body">
              <h5 class="card-title">Active Users</h5>
              <p class="card-text">5</p>
            </div>
          </div>
        </div> --}}
        <div class="col-md-3">
          <div class="card text-white bg-warning">
            <div class="card-body">
              <h5 class="card-title">Total Sales</h5>
              <p class="card-text">Rs. 38000</p>
            </div>
          </div>
        </div>
        <div class="col-md-3">
            <a href="{{ route('admin.admincontroller') }}" class="btn btn-primary text-white"style="color: white;">
            <div class="card text-white bg-info">
              <div class="card-body">
                <p>Admin Controller</p>
              </div>
            </div>
        </a>
          </div>

        {{-- checking  --}}

{{--
        <div class="col-md-3">
            <a href="{{ route('admin.admincontroller') }}" class="btn btn-primary text-white"style="color: white;">
            <div class="card text-white bg-info">
              <div class="card-body">
                <p>Total users</p>
              </div>
            </div>
        </a>
          </div> --}}
      </div>

      <div class="row">
        <div class="col-md-6">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Ordered Details:</h5>
              {{-- <canvas id="activeUsersChart"></canvas> --}}
            </div>
          </div>
        </div>
        <div class="col-md-6">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">User Management</h5>
              <table class="table table-striped">
                <thead>
                    <tr>
                        {{-- <th scope="col">#</th> --}}
                        <th scope="col">Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Contact</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($userDetails as $userDetail)
                        <tr>
                            <th scope="row">{{ $loop->iteration }}</th>
                            <td>{{ $userDetail->name }}</td>
                            <td>{{ $userDetail->email }}</td>
                            <td>{{ $userDetail->phone }}</td>
                            <td>
                                <a href="{{ route('admin.edit', $userDetail->id) }}" class="btn btn-sm btn-primary">Edit</a>
                                <form action="{{ route('admin.delete', $userDetail->id) }}" method="POST" style="display:inline;">
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

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.7.1/dist/chart.min.js"></script>
    {{-- <script>
      // Pie Chart for Active Users
      const ctx = document.getElementById('activeUsersChart').getContext('2d');
      const activeUsersChart = new Chart(ctx, {
        type: 'pie',
        data: {
          labels: ['Active', 'Inactive'],
          datasets: [{
            label: 'Users',
            data: [5, 2], // Example data
            backgroundColor: ['#28a745', '#dc3545'],
          }]
        },
        options: {
          responsive: true,
        }
      });
    </script> --}}
    @endsection
