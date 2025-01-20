<!doctype html>
<html lang="en">

@include('layouts.head')

<body>
    @include('layouts.nav_bar')

    <div class="container">
        @yield('content')
    </div>

    @include('layouts.footer')

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script>
    <script  src="{{ asset('assets/js/jquery-3.6.4.min.js') }}"></script>
    <script>
        function showToggler(){
            $("#user_drop_item").toggleClass("d-none")
        }
    </script>
</body>

</html>
