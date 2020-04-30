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
                        <li class="nav-item"><a href="{{ route('user.logout') }}" class="nav-link">Log out</a></li>
                    
                        
                    @endguest
                </ul>
            </div>
        </div>
    </nav>
    <!-- /Navbar -->
</header>
<section class="d-flex align-items-center dark-overlay bg-cover header-utama">
    <div class="container py-6 py-lg-7 text-white overlay-content text-center">
        <div class="row">
            <div class="col-xl-10 mx-auto">
                <h1 class="display-3 font-weight-bold text-shadow">EH - BIMBEL</h1>
                <p class="text-lg text-shadow">Pilihlah bimbel favoritmu.</p>
            </div>
        </div>
    </div>
</section>
<div class="container">
    <div class="search-bar rounded p-3 p-lg-4 position-relative mt-n5 z-index-20">

        {{-- Search Bimble  --}}
     
        <form action="{{ route('front.index') }}">               
        <div class="row">
                <div class="col-lg-4 d-flex align-items-center form-group">
                    <input type="text" name="keyword" placeholder="Mau cari Bimbel?"
                class="form-control border-0 shadow-0" value="{{ Request::get('keyword') }}">
                </div>
       
                <div class="col-md-6 col-lg-2 d-flex align-items-center form-group">
                    <div class="input-label-absolute input-label-absolute-right w-100">
                        <label for="location" class="label-absolute"><i class="fa fa-crosshairs"></i>
                            <div class="sr-only">Kota</div>
                        </label>
                        <input type="text" name="location" placeholder="Lokasi"
                            class="form-control border-0 shadow-0">
                    </div>
                </div>

                <div class="col-md-6 col-lg-3 d-flex align-items-center form-group no-divider">
                    <form action="{{ route('front.index') }}"> 
                    <select id="nama_kategori" name="nama_kategori" data-style="btn-form-control" class="selectpicker" value="Kategori">
                        @if ($kategori->count() > 0)
                        @foreach ($kategori as $row)
                        <option value="{{$row->id}}">{{ $row->nama_kategori }}</option>
                        @endforeach
                        @else
                        Data Kosong
                        @endif
                        
                    </select>
                    
                </div>
                <div class="col-lg-2 form-group mb-0">
                    <button type="submit" class="btn btn-primary btn-block h-100">Cari</button>
                </div>
            </div>
        </form>


    </div>
</div>