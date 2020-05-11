<header class="header">
    <!-- Navbar-->
    <nav class="navbar navbar-expand-lg fixed-top shadow navbar-light bg-white">
        <div class="container-fluid">
            <div class="d-flex align-items-center"><a href="{{route('front.index')}}" class="navbar-brand py-1">
                    <img src="{{asset('assets/frontend/img/logo.png') }}" alt="Directory logo" style="width: 150px;"></a>

                    
                <form action="#" id="search" class="form-inline d-none d-sm-flex">
                    <div
                        class="input-label-absolute input-label-absolute-left input-reset input-expand ml-lg-2 ml-xl-3">
                        <label for="search_search" class="label-absolute"><i class="fa fa-search"></i><span
                                class="sr-only">What
                                are you looking for?</span></label>
                        <input id="search_search" placeholder="Search" aria-label="Search"
                            class="form-control form-control-sm border-0 shadow-0 bg-gray-200">
                        <button type="reset" class="btn btn-reset btn-sm"><i class="fa-times fas"></i></button>
                    </div>
                </form>

            </div>
            <button type="button" data-toggle="collapse" data-target="#navbarCollapse"
                aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation"
                class="navbar-toggler navbar-toggler-right"><i class="fa fa-bars"></i></button>
            <!-- Navbar Collapse -->
            <div id="navbarCollapse" class="collapse navbar-collapse">
                <ul class="navbar-nav ml-auto">
                    @guest
                    <li class="nav-item"><a href="#" class="nav-link active">Beranda</a></li>
                    <li class="nav-item"><a href="#" class="nav-link active">Pusat Bantuan</a></li>
                    @if (Route::has('register'))
                        <li class="nav-item"><a href="{{ route('login') }}" class="nav-link">Sign in</a></li>
                        <li class="nav-item"><a href="{{ route('register') }}" class="nav-link">Sign up</a></li>
                    @endif
                    @else
                        <li class="nav-item"><a href="#" class="nav-link active">Beranda</a></li>
                        <li class="nav-item"><a href="#" class="nav-link active">Pusat Bantuan</a></li>
                        <li class="nav-item"><a href="#" class="nav-link">{{ Auth::user()->nama_pendaftar }}</a></li>
                        <li class="nav-item"><a href="{{ route('user.logout') }}" class="nav-link badge badge-primary mt-1 text-light">Log Out</a></li>
                    
                        
                    @endguest
                </ul>
            </div>
        </div>
    </nav>
    <!-- /Navbar -->
</header>