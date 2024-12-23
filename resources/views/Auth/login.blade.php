<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Login</title>
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
      background: #fccb90;
      background: -webkit-linear-gradient(to right, #ee7724, #d8363a, #dd3675, #b44593);
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
    .bodycontainer {
      height: auto%;
      width: 100%;
      margin: 0px;
    }
    .divider:after,
    .divider:before {
      content: "";
      flex: 1;
      height: 1px;
      background: #eee;
    }
    .h-custom {
      height: calc(100% - 73px);
    }
    @media (max-width: 450px) {
      .h-custom {
        height: 100%;
      }
    }
  </style>
</head>
<body>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script>
  <nav class="navbar navbar-expand-lg">
    <div class="container-fluid">
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="{{ route('index') }}">
                <img src="{{ asset('assets/image/logo1.png') }}" alt="Yfasma"
                style="height: 40px; padding-top: 0; margin-top: 0;">
            </a>
        </ul>
      </div>
    </div>
  </nav>
  <section class="vh-100">
    <div class="row d-flex justify-content-center align-items-center h-100" >

      <div class="row bg-light shadow rounded p-4" style="max-width: 800px; align-items: center;"style="background-color:#eee ">
        <div class="col-md-4 col-lg-4 col-xl-4">
          <img src="{{ asset('assets/image/yfasmaloginfinal.png') }}" class="d-block w-100" alt="Image">
        </div>
        <div class="col-md-8 col-lg-6 col-xl-4 offset-xl-1">
            <h2>Login</h2><br/>
                  <form method="POST" action="{{ route('login.submit') }}">
            @csrf
            <div class="form-outline mb-4">
              <label class="form-label" for="email">Email address</label>
              <input type="email" id="email" name="email" class="form-control @error('email') is-invalid @enderror" placeholder="Enter a valid email address" required autofocus>
              @error('email')
              <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
              </span>
              @enderror
            </div>
            <div class="form-outline mb-3">
              <label class="form-label" for="password">Password</label>
              <input type="password" id="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="Enter password" required>
              @error('password')
              <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
              </span>
              @enderror
            </div>
            {{-- <div class="d-flex justify-content-between align-items-center">
              <div class="form-check mb-0">
                <input class="form-check-input me-2" type="checkbox" value="" id="rememberMe" />
                <label class="form-check-label" for="rememberMe">Remember me</label>
              </div>
              <a href="#" class="text-body">Forgot password?</a>
            </div> --}}
            <div class="text-center text-lg-start mt-4 pt-2">
              <button type="submit" class="btn btn-primary">Login</button>
              <p class="small fw-bold mt-2 pt-1 mb-0">Don't have an account? <a href="{{ route('registration.form') }}" class="link-danger">Register</a></p>
            </div>
          </form>
        </div>
      </div>
    </div>
  </section>
  <!--footer-->
  <div class="container-fluid p-0">
    <footer class="text-center text-lg-start text-white" style="background-color: #1c2331">
      <div>
        <a href="" class="text-white me-4"><i class="fab fa-facebook-f"></i></a>
        <a href="" class="text-white me-4"><i class="fab fa-twitter"></i></a>
        <a href="" class="text-white me-4"><i class="fab fa-google"></i></a>
        <a href="" class="text-white me-4"><i class="fab fa-instagram"></i></a>
        <a href="" class="text-white me-4"><i class="fab fa-linkedin"></i></a>
        <a href="" class="text-white me-4"><i class="fab fa-github"></i></a>
      </div>
      <section>
        <div class="container text-center text-md-start mt-5">
          <div class="row mt-3">
            <div class="col-md-3 col-lg-4 col-xl-3 mx-auto mb-4">
              <h6 class="text-uppercase fw-bold">Yfasma</h6>
              <hr class="mb-4 mt-0 d-inline-block mx-auto" style="width: 60px; background-color: #7c4dff; height: 2px" />
              <p>
                Our website is based on providing our customers with custom-designed dresses according to their needs, mainly focusing on events.
              </p>
            </div>
            <div class="col-md-2 col-lg-2 col-xl-2 mx-auto mb-4">
              <h6 class="text-uppercase fw-bold">Products</h6>
              <hr class="mb-4 mt-0 d-inline-block mx-auto" style="width: 60px; background-color: #7c4dff; height: 2px" />
              <p><a href="cultural.html" class="text-white">Cultural</a></p>
              <p><a href="western.html" class="text-white">Western</a></p>
              <p><a href="women.html" class="text-white">Women</a></p>
              <p><a href="men.html" class="text-white">Men</a></p>
            </div>
            <div class="col-md-3 col-lg-2 col-xl-2 mx-auto mb-4">
              <h6 class="text-uppercase fw-bold">Useful links</h6>
              <hr class="mb-4 mt-0 d-inline-block mx-auto" style="width: 60px; background-color: #7c4dff; height: 2px" />
              <p><a href="#!" class="text-white">Your Account</a></p>
              <p><a href="#!" class="text-white">Become an Affiliate</a></p>
              <p><a href="#!" class="text-white">Shipping Rates</a></p>
              <p><a href="#!" class="text-white">Help</a></p>
            </div>
            <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mb-md-0 mb-4">
              <h6 class="text-uppercase fw-bold">Contact</h6>
              <hr class="mb-4 mt-0 d-inline-block mx-auto" style="width: 60px; background-color: #7c4dff; height: 2px" />
              <p><i class="fas fa-home mr-3"></i>Mid-Baneshor, Kathmandu, Nepal</p>
              <p><i class="fas fa-envelope mr-3"></i>info@yfasma.com</p>
              <p><i class="fas fa-phone mr-3"></i> + 977 551 2345</p>
              <p><i class="fas fa-print mr-3"></i> + 977 551 2346</p>
            </div>
          </div>
        </div>
      </section>
      <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2)">
        © 2024 Copyright:
        <a class="text-white" href="https://mdbootstrap.com/">Yfasma</a>
      </div>
    </footer>
  </div>
</body>
</html>
