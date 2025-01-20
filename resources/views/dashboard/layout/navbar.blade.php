<nav class="navbar navbar-expand-lg navbar-light bg-light top-navbar">
    <div class="container-fluid">
        <a class="navbar-brand" href="{{ route('admin.profile') }}">
          <img src="{{ asset('assets/image/logo1.png') }}" alt="Yfasma" class="navbar-logo">
          </a>
          <div class="d-flex align-items-center">
                 <div class="user_icons">
                  <span>{{ Auth::user()->name }}</span>
                  <img src="{{ asset('assets/image/user.png') }}" alt="User" style="height: 35px; cursor:pointer" onclick="showToggler()">
                      <div class="d-none" id="user_drop_item">
                          <a href="{{ route('logout') }}" >Logout</a>
                      </div>
              </div>
          </div>
    </div>
</nav>
