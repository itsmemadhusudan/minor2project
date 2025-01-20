<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="{{ asset('assets/css/dashboard.css') }}" >
    @yield("style")
</head>
<body>
    <div class="container-fluid">
       <!-- Top Bar -->
        @include('dashboard.layout.navbar')
        <div class="row">
            <!-- Sidebar -->
            <nav id="sidebar" class="col-md-3 col-lg-2 d-md-block bg-light sidebar">
                <div class="position-sticky">
                    <ul class="nav flex-column">
                         <li class="nav-item">
                            <a class="nav-link active" href="{{ route('admin.profile') }}">
                                <i class="fas fa-home me-2"></i>
                                Dashboard
                            </a>
                        </li>
                         <li class="nav-item">
                            <a class="nav-link" href="{{ route('admin.orders.index') }}">
                                <i class="fas fa-shopping-cart me-2"></i>
                                Orders
                            </a>
                        </li>
                        <li class="nav-item">
                            @if(Auth::check() && Auth::user()->role == 'admin')
                                <a class="nav-link" href="{{ route('admin.customers.index') }}">
                                    <i class="fas fa-users me-2"></i>
                                    Customers
                                </a>
                            @endif
                            </li>
                         <li class="nav-item">
                            <a class="nav-link" href="{{ route('admin.products.index') }}">
                                <i class="fas fa-chart-bar me-2"></i>
                                Products
                            </a>
                        </li>
                        <li class="nav-item">
                            @if(Auth::check() && Auth::user()->role == 'admin')
                                <a class="nav-link" href="{{ route('admin.users.index') }}">
                                    <i class="fas fa-user me-2"></i>
                                    Employees
                                </a>
                            @endif
                        </li>

                    </ul>
                 </div>
            </nav>
            <!-- Main Content -->
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">


              @yield('content')

             </main>
        </div>


    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script  src="{{ asset('assets/js/jquery-3.6.4.min.js') }}"></script>
    @yield("script")
    <script>
        function showToggler(){
            $("#user_drop_item").toggleClass("d-none")
        }
    </script>
</body>
</html>
