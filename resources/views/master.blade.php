<!doctype html>
<html lang="en">

@include('layouts.head')

<body>

    @include('layouts.nav_bar')

    @yield('content')
    <!--footer-->
    @include('layouts.footer')

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script>
</body>

</html>
