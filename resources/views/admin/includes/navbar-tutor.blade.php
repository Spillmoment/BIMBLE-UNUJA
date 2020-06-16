<!-- Header-->
<header id="header" class="header">
  <div class="top-left">
      <div class="navbar-header">
          <a class="navbar-brand" href="{{ route('dashboard') }}">
            <img src="{{ asset('assets/frontend/img/logo.png') }}" alt="" class="w-50 mb-2 mt-2" />
        </a>
          <a class="navbar-brand hidden" href="{{ route('dashboard') }}">
            <img src="{{ asset('assets/frontend/img/logo.png') }}" alt="" class="w-50 mb-2 mt-2" />
        </a>
          <a id="menuToggle" class="menutoggle"><i class="fa fa-bars"></i></a>
      </div>
  </div>
  <div class="top-right">
      <div class="header-menu">

        <div class="user-area dropdown float-right">
                <a href="#" class="dropdown-toggle active" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <img class="user-avatar rounded-circle img-thumbnail img-fluid" src="{{ url('uploads/tutor/'.Auth::user()->foto ) }}" alt="User Avatar" height="70px" width="70px"> 
                </a>
  
                <div class="user-menu dropdown-menu">
                    <a class="nav-link" href="#"><i class="fa fa-user"></i>{{ Auth::user()->nama_tutor }}</a>
                    <a class="nav-link" href="{{ route('tutor.logout') }}"><i class="fa fa-power-off"></i>Logout</a>
                </div>

            </div>

      </div>
  </div>
</header>
<!-- /#header -->