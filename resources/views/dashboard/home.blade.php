@extends('dashboard.app')
@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Dashboard</h1>
    <div class="btn-toolbar mb-2 mb-md-0">
      <button type="button" class="btn btn-sm btn-outline-secondary">
        <span data-feather="calendar"></span>
        This week
      </button>
    </div>
  </div>
<div class="row">
    <div class="col-md-4 mb-4">
        <div class="card shadow">
            <div class="card-body">
              <div class="d-flex align-items-center">
                  <i class="fas fa-box-open fa-2x me-3 text-primary"></i>
                  <div>
                      <h5 class="card-title mb-0">Total Orders</h5>
                       <span class="fs-3">120</span>
                  </div>

              </div>

            </div>
        </div>
    </div>

     <div class="col-md-4 mb-4">
         <div class="card shadow">
            <div class="card-body">
              <div class="d-flex align-items-center">
                  <i class="fas fa-user-plus fa-2x me-3 text-success"></i>
                  <div>
                      {{-- <h5 class="card-title mb-0">New Customers</h5> --}}
                      @if (Auth::check() && Auth::user()->role == 'admin')
                         <h5 class="card-title mb-0">New Customers</h5>
                      @endif

                      <span class="fs-3">25</span>
                  </div>

              </div>

            </div>
        </div>
    </div>

     <div class="col-md-4 mb-4">
        <div class="card shadow">
            <div class="card-body">
              <div class="d-flex align-items-center">
                    <i class="fas fa-chart-line fa-2x me-3 text-warning"></i>
                  <div>
                      <h5 class="card-title mb-0">Total Revenue</h5>
                     <span class="fs-3">$12,000</span>
                  </div>

              </div>

            </div>
        </div>
    </div>
</div>

<div class="card mt-4 shadow">
  <div class="card-header">
      <h5 class="mb-0">Recent Orders</h5>
  </div>
  <div class="card-body">
      {{-- <table class="table table-hover">
           <thead>
              <tr>
                 <th>Order ID</th>
                 <th>Customer</th>
                 <th>Date</th>
                 <th>Amount</th>
                 <th>Status</th>
              </tr>
           </thead>
           <tbody>
              <tr>
                 <td>#1234</td>
                 <td>John Doe</td>
                 <td>2023-11-15</td>
                 <td>$100</td>
                 <td><span class="badge bg-success">Completed</span></td>
              </tr>
               <tr>
                 <td>#1235</td>
                 <td>Jane Doe</td>
                 <td>2023-11-15</td>
                 <td>$150</td>
                 <td><span class="badge bg-warning">Pending</span></td>
              </tr>
              <tr>
                 <td>#1236</td>
                 <td>Peter Pan</td>
                 <td>2023-11-15</td>
                 <td>$200</td>
                 <td><span class="badge bg-danger">Cancelled</span></td>
              </tr>
           </tbody>
      </table> --}}
      <table class="table table-hover table-bordered">
        <thead class="thead-dark">
            <tr>
                {{-- <th scope="col">ID</th> --}}
                <th scope="col">Product Name</th>
                <th scope="col">Email</th>
                <th scope="col">Description</th>
                <th scope="col">Price</th>
                <th scope="col">Category</th>
            </tr>
        </thead>
        {{-- <tbody>
            @foreach($uploads as $upload)
            <tr>
                <td>{{ $upload->designer_name }}</td>
                <td>{{ $upload->email }}</td>
                <td>{{ $upload->description }}</td>
                <td>${{ $upload->price }}</td>
                <td>{{ $upload->category }}</td>
            </tr>
            @endforeach
        </tbody>
    </table> --}}
  </div>

</div>

@endsection
