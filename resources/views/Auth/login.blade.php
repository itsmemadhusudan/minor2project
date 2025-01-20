<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('assets/css/register.css') }}">

</head>
<body>
  <div class="logo-container">
      <a href="{{ route('index') }}">
          <img src="{{ asset('assets/image/logo1.png') }}" alt="App Logo" class="app-logo">
      </a>
  </div>
    <div class="login-container">
        <div class="login-image">
           <img src="{{ asset('assets/image/yfasmaloginfinal.png') }}" alt="Login Image">
        </div>
        <div class="login-form">
            <h2>Login</h2>
            <form method="POST" action="{{ route('login.submit') }}">
                @csrf
                 <div class="form-group">
                    <label for="email">Email Address</label>
                    <input type="email" id="email" name="email" class="form-control @error('email') is-invalid @enderror" placeholder="Enter your email address" required autofocus>
                     @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                </div>
               <div class="form-group">
                <label for="password">Password</label>
                 <div class="password-container">
                     <input type="password" id="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="Enter your password" required>
                   <i class="fas fa-eye password-toggle" id="passwordToggle" ></i>
                     @error('password')
                         <span class="invalid-feedback" role="alert">
                           <strong>{{ $message }}</strong>
                       </span>
                     @enderror
                </div>
                </div>
               <button type="submit" class="btn btn-primary">Login</button>
               <p class="register-link">Don't have an account? <a href="{{ route('registration.form') }}">Register</a></p>
            </form>
        </div>
    </div>
    <script>
    const passwordInput = document.getElementById("password");
    const passwordToggle = document.getElementById("passwordToggle");

    passwordToggle.addEventListener("click", function () {
      if (passwordInput.type === "password") {
        passwordInput.type = "text";
        passwordToggle.classList.remove("fa-eye");
        passwordToggle.classList.add("fa-eye-slash");
      } else {
         passwordInput.type = "password";
         passwordToggle.classList.remove("fa-eye-slash");
        passwordToggle.classList.add("fa-eye");
      }
     });
    </script>
</body>
</html>