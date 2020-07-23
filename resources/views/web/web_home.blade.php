<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Eh-Bimble | Home</title>
  <meta name="description" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="robots" content="all,follow">
  <!-- Price Slider Stylesheets -->
  <link rel="stylesheet" href="{{ asset('assets/frontend/vendor/nouislider/nouislider.css') }}">
  <!-- Google fonts - Playfair Display-->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Playfair+Display:400,400i,700">
  <!-- Google fonts - Poppins-->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,400i,700">
  <!-- Magnigic Popup-->
  <link rel="stylesheet" href="{{asset('assets/frontend/vendor/magnific-popup/magnific-popup.css')}}">
  <!-- theme stylesheet-->
  <link rel="stylesheet" href="{{ asset('assets/frontend/vendor/bootstrap/style.default.css')}}" id="theme-stylesheet">
  <!-- Custom stylesheet - for your changes-->
  <link rel="stylesheet" href="{{asset('assets/frontend/css/custom.css')}}">
  <!-- Favicon-->
  <link rel="shortcut icon" href="{{ asset('assets/frontend/img/favicon.png') }}">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/css/all.min.css">
  <!-- Owl carousel -->
  <link rel="stylesheet" href="{{ asset('assets/frontend/vendor/owl-carousel/dist/assets/owl.carousel.min.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/frontend/vendor/owl-carousel/dist/assets/owl.theme.default.css') }}">

<link rel="stylesheet" href="https://unpkg.com/leaflet@1.6.0/dist/leaflet.css" />
<!-- Make sure you put this AFTER Leaflet's CSS -->

{{-- <style>
    #mapid {
        min-height: 500px;
    }
</style> --}}
</head>

<body style="padding-top: 72px;">
  <header class="header">
    <!-- Navbar-->
    <nav class="navbar navbar-expand-lg fixed-top shadow navbar-light bg-white">
      <div class="container-fluid">
        <div class="d-flex align-items-center"><a href="index.html" class="navbar-brand py-1">
            <img src="{{ asset('assets/frontend/img/logo.png') }}" alt="Directory logo" style="width: 150px;"></a>
          <form action="#" id="search" class="form-inline d-none d-sm-flex scroll">
            <div class="input-label-absolute input-label-absolute-left input-reset input-expand ml-lg-2 ml-xl-3">
              <label for="search_search" class="label-absolute"><i class="fa fa-search"></i><span class="sr-only">What
                  are you looking for?</span></label>
              <input id="search_search" placeholder="Search" aria-label="Search"
                class="form-control form-control-sm border-0 shadow-0 bg-gray-200">
              <button type="reset" class="btn btn-reset btn-sm"><i class="fa-times fas"></i></button>
            </div>
          </form>
        </div>
        <button type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse"
          aria-expanded="false" aria-label="Toggle navigation" class="navbar-toggler navbar-toggler-right"><i
            class="fa fa-bars"></i></button>
        <!-- Navbar Collapse -->
        <div id="navbarCollapse" class="collapse navbar-collapse">
          <ul class="navbar-nav ml-auto">
            
            @guest
            <li class="nav-item"><a href="{{ route('front.index') }}" class="nav-link 
                {{ (Request::route()->getName() == 'front.index') ? 'active' : '' }}">Beranda</a></li>
            <li class="nav-item"><a href="#" class="nav-link ">Pusat Bantuan</a></li>
            <li class="nav-item"><a href="{{ route('front.kursus') }}" class="nav-link  
                {{ (Request::route()->getName() == 'front.kursus') ? 'active' : '' }}">Kursus</a>
            </li>

            @if (Route::has('register'))
            <li class="nav-item"><a href="{{ route('register') }}" class="nav-link  
                {{ (Request::route()->getName() == 'register') ? 'active' : '' }}">Daftar</a></li>
            <li class="nav-item"><a href="{{ route('login') }}" class="nav-link 
                 {{ (Request::route()->getName() == 'login') ? 'active' : '' }}">
                    Masuk
                </a></li>
            @endif
                @endguest
           
                @auth
                <li class="nav-item"><a href="{{ route('front.index') }}" class="nav-link 
                    {{ (Request::route()->getName() == 'front.index') ? 'active' : '' }}">
                        Beranda
                    </a></li>
                <li class="nav-item"><a href="#" class="nav-link">
                        Pusat Bantuan
                    </a></li>
                <li class="nav-item"><a href="{{ route('front.kursus') }}" class="nav-link 
                    {{ (Request::route()->getName() == 'front.kursus') ? 'active' : '' }}">
                      Kursus
        
                <li class="nav-item"><a href="{{ route('order.view') }}" class="nav-link 
                    {{ (Request::route()->getName() == 'order.view') ? 'active' : '' }}">
                        Pesanan
                    </a></li>
                <li class="nav-item dropdown ml-lg-3">
                    <a id="userDropdownMenuLink" href="#" data-toggle="dropdown" aria-haspopup="true"
                        aria-expanded="false">
                        <img src="{{ Storage::url('uploads/pendaftar/profile/'.Auth::user()->foto ) }}"
                class="avatar avatar-sm avatar-border-white mr-2">
                </a>
                <div class="d-flex">
                    <div class="dropdown-menu dropdown-menu-right z-index-1;">
                        <a class="dropdown-item" href="{{ route('profile.index') }}">Profile</a>
                        <a class="dropdown-item" href="{{ route('user.kursus.success') }}">My Kursus</a>
                        <a class="dropdown-item" href="{{ route('user.logout') }}">
                            <i class="fas fa-sign-out-alt mr-2 text-muted"></i>
                            Keluar
                        </a>
                    </div>
                </div>
                </li>
                @endauth
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

        <div class="row">
            <div class="col-lg-4 d-flex align-items-center form-group">
                <form action="{{ route('front.index') }}">
                    <input type="text" name="keyword" placeholder="Mau cari Bimbel?"
                        class="form-control border-0 shadow-0" value="{{ Request::get('keyword') }}">
            </div>

            <div class="col-lg-2 form-group mb-0">
                <button type="submit" class="btn btn-primary btn-block h-100"><span style="font-size: 15px">Cari</span></button>
            </div>
            </form>

            <div class="col-md-4 col-lg-3 d-flex align-items-center form-group no-divider">
                <form action="{{ route('front.index') }}">
                    <select id="nama_kategori" name="kategori" data-style="btn-form-control" class="selectpicker"
                        value="Kategori">
                        @foreach ($kategori as $row)
                        <option value="{{$row->id}}">{{ $row->nama_kategori }}</option>
                        @endforeach
                    </select>
            </div>
            <div class="col-lg-2 form-group mb-0">
                <button type="submit" class="btn btn-primary btn-block h-100"><span style="font-size: 15px">Cari</span></button>
            </div>
        </div>
        </form>

    </div>
</div>

 
  <section class="py-6 bg-gray-100">
    <div class="container">
      <div class="row mb-5">
        <div class="col-md-8">
          <h4>Rekomendasi Bimble</h4>
          @if (Request::get('kategori'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        <span class="sr-only">Close</span>
                    </button>
                    <strong>Hasil Pencarian Kategori :<b> {{ $nama_kategori }} </b> </strong>
                </div>
                @endif
        </div>

      </div>
      <div class="row">
        <div class="col-md-12">
            @if ($kursus->count() > 0)
            <div class="owl-carousel">
                @forelse ($kursus as $krs)
                <div data-marker-id="59c0c8e322f3375db4d89128" class="w-100 h-100 hover-animate">
                    <div class="card card-kelas h-100 border-0 shadow">
                        <div class="card-img-top overflow-hidden gradient-overlay">
                            <img src="{{ Storage::url('public/'.$krs->gambar_kursus) }}" style="height: 10em;"
                                alt="{{ $krs->nama_kursus }}" class="img-fluid" /><a
                                href="{{ route('front.detail', [$krs->slug]) }}" class="tile-link"></a>
                            <div class="card-img-overlay-bottom z-index-20">
                                <div class="media text-white text-sm align-items-center">
                                    @foreach ($krs->tutor as $sensei)
                                    <img src="{{ Storage::url('public/'.$sensei->foto) }}" alt="{{ $sensei->nama_tutor }}"
                                        class="avatar-profile avatar-border-white mr-2" height="50px" />
                                    <div class="media-body">{{ $sensei->nama_tutor }}</div>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                        <div class="card-body d-flex align-items-center">
                            <div class="w-100">
                                <h6 class="card-title"><a href="{{ route('front.detail', [$krs->slug]) }}"
                                        class="text-decoration-none text-dark">{{$krs->nama_kursus}}</a></h6>
                                <div class="d-flex card-subtitle mb-3">
                                    <p class="flex-grow-1 mb-0 text-muted" style="font-size: 12.5px">
                                        @foreach ($krs->kategori as $item)
                                        {{$item->nama_kategori}}</p>
                                    @endforeach
                                    <p class="flex-shrink-1 mb-0 card-stars text-xs text-right">
                                        @php
                                        $minat_kursus = $krs->order_detail_count / 10;
                                        $rating = round($minat_kursus * 2 ) / 2;
                                        @endphp

                                        @for($x = 5; $x > 0; $x--)
                                        @php
                                        if($rating > 0.5){
                                        echo '<i class="fa fa-star text-warning"></i>';
                                        }elseif($rating <= 0 ){ echo '<i class="fa fa-star text-gray-300"></i>' ;
                                            }else{ echo '<i class="fa fa-star-half text-warning"></i>' ; }
                                            $rating--; @endphp @endfor </p> </div> 
                                           
                                           {{-- @if ($status_kursus) <span
                                            style="width: 45px"
                                            class="badge badge-success badge-pill badge-lg float-right">
                                            <i class="fas fa-check-circle"></i>
                                            </span>
                                            @endif --}}

                                            @if ($krs->diskon_kursus == 0)
                                            <p class="card-text text-muted"><span class="h4 text-primary">
                                                    @currency($krs->biaya_kursus)</span>
                                                per Bulan</p>
                                            @else
                                            <p class="card-text text-muted">
                                                <span class="h4 text-primary"> @currency($krs->biaya_kursus -
                                                    ($krs->biaya_kursus * ($krs->diskon_kursus/100)))</span>
                                                per Bulan
                                            </p>
                                            <p class="card-text ">
                                                <strike>
                                                    <span
                                                        class="h6 text-danger">@currency($krs->biaya_kursus)</span>
                                                </strike>
                                                <strong class="ml-2">Diskon</strong> @currency($krs->diskon_kursus)%
                                            </p>

                                            @endif

                                </div>
                            </div>
                        </div>
                    </div>
                    @empty
                    @endforelse
                </div>
                @else
                <div class="col text-center mb-5">
                    <img width="200px"
                        src="https://i.pinimg.com/originals/ea/66/cd/ea66cdf309ec3341db8d38bb298afa0f.gif">
                    <p class="font-weight-bold mt-3" style="color: #071C4D;"> Pencarian tidak ditemukan
                    </p>
                    <a href="{{ route('front.index') }}" class="btn btn-primary btn-md" style="background: #071C4D">
                        <i class="fas fa-caret-left"></i> Kembali
                    </a>
                </div>

                @endif
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 d-lg-flex align-items-center justify-content-end">
                <a href="{{ route('front.kursus') }}" class="text-primary text-sm"> Lihat Semua<i
                        class="fas fa-angle-double-right ml-2"></i></a>
            </div>
        </div>

        <div class="row">
            <div class="col">
                <div id="mapid"></div>
            </div>
        </div>

        <div class="row">
            {{ $kursus->appends(Request::all())->links() }}
        </div>

    </div>
      
    </div>
  </section>


  <!-- Footer-->
 @include('web.layouts.footer')
  <!-- /Footer end-->
  <!-- JavaScript files-->

  <!-- jQuery-->
  <script src="{{ asset('assets/frontend/vendor/jquery/jquery.min.js') }}"></script>
  <!-- Bootstrap JS bundle - Bootstrap + PopperJS-->
  <script src="{{ asset('assets/frontend/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <!-- Magnific Popup - Lightbox for the gallery-->
  <script src="{{ asset('assets/frontend/vendor/magnific-popup/jquery.magnific-popup.min.js') }}"></script>
  <!-- Smooth scroll-->
  <script src="{{ asset('assets/frontend/vendor/smooth-scroll/smooth-scroll.polyfills.min.js') }}"></script>
  <!-- Bootstrap Select-->
  <script src="{{ asset('assets/frontend/vendor/bootstrap-select/js/bootstrap-select.min.js') }}"></script>
  <!-- Object Fit Images - Fallback for browsers that don't support object-fit-->
  <script src="{{ asset('assets/frontend/vendor/object-fit-images/ofi.min.js') }}"></script>
  <script src="{{ asset('assets/frontend/vendor/jquery.cookie/jquery.cookie.js') }}"> </script>
  <script src="{{ asset('assets/frontend/js/demo.36f8799a.js') }}"></script>
  <!-- Main Theme JS file    -->
  <script src="{{ asset('assets/frontend/js/theme.55f8348b.js') }}"></script>
  <!-- owl carousel -->
  <script src="{{ asset('assets/frontend/vendor/owl-carousel/dist/owl.carousel.min.js') }}"></script>
  <script src="{{ asset('assets/frontend/vendor/lib/owlcarousel/owlcarousel-costume.js') }}"></script>
{{-- 
@push('scripts')
<script src="{{ asset('js/app.js') }}"></script>
<script src="https://unpkg.com/leaflet@1.6.0/dist/leaflet.js"></script>

<script>
    var map = L.map('mapid').setView([{
        {
            config('leaflet.map_center_latitude')
        }
    }, {
        {
            config('leaflet.map_center_longitude')
        }
    }], {
        {
            config('leaflet.zoom_level')
        }
    });
    var baseUrl = "{{ url('/') }}";

    L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token={accessToken}', {
        attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, <a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
        maxZoom: 18,
        id: 'mapbox/streets-v11',
        tileSize: 512,
        zoomOffset: -1,
        accessToken: 'pk.eyJ1IjoiZ3VuYXdhbjk4IiwiYSI6ImNrYWN6dmcxczE1M2MyenJ1N2R4MjdsZXYifQ.aLQflQW3Wd-Ei6gQrUtbsw'
    }).addTo(map);

    axios.get('{{ route('api.outlets.index') }}')
        .then(function (response) {
            console.log(response.data);
            L.geoJSON(response.data, {
                    pointToLayer: function (geoJsonPoint, latlng) {
                        return L.marker(latlng);
                    }
                })
                .bindPopup(function (layer) {
                    return layer.feature.properties.map_popup_content;
                }).addTo(map);
        })
        .catch(function (error) {
            console.log(error);
        });

    @can('create', new App\ Outlet)
    var theMarker;

    map.on('click', function (e) {
        let latitude = e.latlng.lat.toString().substring(0, 15);
        let longitude = e.latlng.lng.toString().substring(0, 15);

        if (theMarker != undefined) {
            map.removeLayer(theMarker);
        };

        var popupContent = "Your location : " + latitude + ", " + longitude + ".";
        popupContent += '<br><a href="{{ route('
        outlets.create ') }}?latitude=' + latitude + '&longitude=' + longitude + '">Add new outlet here</a>';

        theMarker = L.marker([latitude, longitude]).addTo(map);
        theMarker.bindPopup(popupContent)
            .openPopup();
    });
    @endcan

</script>

@endpush --}}
</body>


</html>