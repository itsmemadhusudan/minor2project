<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Registration</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .navbar {
            background-color: #b5c99a;
            font-family: 'Montserrat', sans-serif;
            font-size: 16px;
            font-weight: bold;
        }
        .nav-item {
            margin-left: 30px;
        }
        .btn-outline-secondary {
            background-color: #b5c99a;
            color: black;
        }
        .navbar-brand {
            font-family: #b5c99a;
            font-weight: bold;
        }
        .container.my-5 {
            width: auto;
        }
        .gradient-custom-2 {
            /* fallback for old browsers */
            background: #fccb90;

            /* Chrome 10-25, Safari 5.1-6 */
            background: -webkit-linear-gradient(to right, #ee7724, #d8363a, #dd3675, #b44593);

            /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
            background: linear-gradient(to right, #ee7724, #d8363a, #dd3675, #b44593);
        }
        @media (min-width: 768px) {
            .gradient-form {
                height: 100vh !important;
            }
        }
        @media (min-width: 769px) {
            .gradient-custom-2 {
                border-top-right-radius: .3rem;
                border-bottom-right-radius: .3rem;
            }
        }
        .logout {
            background-color: #1c2331;
            color: white;
            font-weight: 200;
            border-radius: 5px;
        }
        .image-container img {
            width: 100%;
            height: auto;
            object-fit: cover;
        }
        .form-container {
            padding: 20px;
        }
    </style>
</head>
<body>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script>
    <nav class="navbar navbar-expand-lg">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.html"><img src="{{ asset('assets/image/logo1.png') }}" alt="Yfasma"
                style="height: 40px; padding-top: 0; margin-top: 0;"></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    {{-- <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="index.html">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="designer.html">Designer</a>
                    </li> --}}
                    <!-- <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="women.html">Women</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="men.html">Men</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="cultural.html">Cultural</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="western.html">Western</a>
                    </li> -->
                    {{-- <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="about.html">About</a>
                    </li>
                </ul>
                <form class="col-12 col-lg-auto mb-3 mb-lg-0 me-lg-3">
                    <div id="the-basics">
                        <div class="input-group">
                            <input name="searchField" id="searchField" type="search" class="form-control form-control-dark" style="width: 426px;">
                            <button class="btn btn-outline-secondary" type="button" id="button-addon2">Search</button>
                        </div>
                    </div>
                </form>
                <button type="button" class="logout">Logout</button>
            </div>
        </div> --}}
    </nav>
    <div class="d-flex justify-content-center align-items-center vh-100">
        <div class="container my-5 bg-light shadow rounded p-4">
            <div class="row">
                <div class="col-md-6 image-container">
                    <img src="{{ asset('assets/image/pic.png') }}" alt="Your Image Description" style="width:300px;height: 650px;"/>
                </div>
                <div class="col-md-6 form-container">
                    <h2>Registration Form</h2>
                    <form method="POST" action="{{ route('register') }}">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autofocus>
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required>
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required>
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="password-confirm" class="form-label">Confirm Password</label>
                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                        </div>

                        {{-- <div class="mb-3">
                            <label for="address" class="form-label">Address</label>
                            <input id="address" type="text" class="form-control @error('address') is-invalid @enderror" name="address" value="{{ old('address') }}" required>
                            @error('address')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div> --}}

                        <div class="mb-3">
                            <label for="phone" class="form-label">Phone Number</label>
                            <input id="phone" type="tel" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') }}" required>
                            @error('phone')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <button type="submit" class="btn btn-primary">Register</button>
                        </div>
                    </form>
                 </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <div class="container-fluid p-0">
        <footer class="text-center text-lg-start text-white" style="background-color: #1c2331">
            <!-- Section: Links -->
            <section class="">
                <div class="container text-center text-md-start mt-5">
                    <div class="row mt-3" style="padding-top: 35px;">
                        <div class="col-md-3 col-lg-4 col-xl-3 mx-auto mb-4">
                            <h6 class="text-uppercase fw-bold">Yfasma</h6>
                            <hr class="mb-4 mt-0 d-inline-block mx-auto" style="width: 60px; background-color: #7c4dff; height: 2px"/>
                            <p>
                                Our website is based on providing our customers with custom-designed dresses according to their needs. Mainly, our website focuses on events.
                            </p>
                        </div>
                        <div class="col-md-2 col-lg-2 col-xl-2 mx-auto mb-4">
                            <h6 class="text-uppercase fw-bold">Products</h6>
                            <hr class="mb-4 mt-0 d-inline-block mx-auto" style="width: 60px; background-color: #7c4dff; height: 2px"/>
                            <p>
                                <a href="cultural.html" class="text-white">Cultural</a>
                            </p>
                            <p>
                                <a href="western.html" class="text-white">Western</a>
                            </p>
                            <p>
                                <a href="women.html" class="text-white">Women</a>
                            </p>
                            <p>
                                <a href="men.html" class="text-white">Men</a>
                            </p>
                        </div>
                        <div class="col-md-3 col-lg-2 col-xl-2 mx-auto mb-4">
                            <h6 class="text-uppercase fw-bold">Useful links</h6>
                            <hr class="mb-4 mt-0 d-inline-block mx-auto" style="width: 60px; background-color: #7c4dff; height: 2px"/>
                            <p>
                                <a href="#!" class="text-white">Your Account</a>
                            </p>
                            <p>
                                <a href="#!" class="text-white">Become an Affiliate</a>
                            </p>
                            <p>
                                <a href="#!" class="text-white">Shipping Rates</a>
                            </p>
                            <p>
                                <a href="#!" class="text-white">Help</a>
                            </p>
                        </div>
                        <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mb-md-0 mb-4">
                            <h6 class="text-uppercase fw-bold">Contact</h6>
                            <hr class="mb-4 mt-0 d-inline-block mx-auto" style="width: 60px; background-color: #7c4dff; height: 2px"/>
                            <p><i class="fas fa-home mr-3"></i>Mid-Baneshor, Kathmandu, Nepal</p>
                            <p><i class="fas fa-envelope mr-3"></i>info@yfasma.com</p>
                            <p><i class="fas fa-phone mr-3"></i> + 977 551 2345</p>
                            <p><i class="fas fa-print mr-3"></i> + 977 551 2346</p>
                        </div>
                    </div>
                </div>
            </section>
            <!-- Copyright -->
            <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2)">
                © 2024 Copyright:
                <a class="text-white" href="https://mdbootstrap.com/">Yfasma</a>
            </div>
        </footer>
    </div>
</body>
</html>
