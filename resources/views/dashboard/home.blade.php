@extends('dashboard.app')
@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Dashboard</h1>
    {{-- <div class="btn-toolbar mb-2 mb-md-0">
      <button type="button" class="btn btn-sm btn-outline-secondary">
        <span data-feather="calendar"></span>
        This week
      </button>
    </div> --}}
  </div>
<div class="row">
    <div class="col-md-4 mb-4">
        <div class="card shadow">
            <div class="card-body">
              <div class="d-flex align-items-center">
                  <i class="fas fa-box-open fa-2x me-3 text-primary"></i>
                  <div>
                      <h5 class="card-title mb-0">Total Orders</h5>
                       <span class="fs-3"> {{ $data['total_order_count'] }}</span>
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
                      <h5 class="card-title mb-0">Total Customers</h5>

                      <span class="fs-3">{{ $data['total_user_count'] }}</span>
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
                     <span class="fs-3">NRP  {{ $data['total_revenue_count'] }}</span>
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
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Order ID</th>
                <th>User</th>
                 <th>Total Amount</th>
                <th>Status</th>
                <th>Payment Type</th>
            </tr>
        </thead>
        <tbody>
        @foreach($data['recent_orders'] as $order)
            <tr>
                <td>{{ $order['id'] }}</td>
                <td>{{ $order['order_id'] }}</td>
                <td>
                    @if($order['user'])
                        {{ $order['user']->name }}
                    @else
                        N/A
                    @endif
                </td>
                <td>NRP {{ $order['total_amount'] }}</td>
                <td>
                    @if($order['status'] == 'pending')
                        <span class="badge bg-warning">Pending</span>
                    @elseif($order['status'] == 'processing')
                        <span class="badge bg-info">Processing</span>
                    @elseif($order['status'] == 'completed')
                        <span class="badge bg-success">Completed</span>
                    @elseif($order['status'] == 'cancelled')
                        <span class="badge bg-danger">Cancelled</span>
                    @endif
                </td>
                <td>{{ $order->payment_type }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
  </div>

</div>

@endsection
