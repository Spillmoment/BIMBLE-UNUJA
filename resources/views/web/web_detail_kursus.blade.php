@extends('web.layouts.main')

@section('title','Bimble Home')
    
@section('content')
<div class="container py-5">
    <div class="row">
      <div class="col-lg-8">
        <div class="text-block">
          <h4>Tentang Kelas {{ $kursus->nama_kursus }}</h4>
          <p class="text-muted font-weight-light">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Eligendi in
            recusandae debitis vitae obcaecati, facilis, laboriosam ad veniam unde consectetur tenetur laborum ipsam
            vero aliquam molestias minima quae! Pariatur, vitae.</p>
        </div>
        <div class="text-block">
          <h4 class="mb-4">Fasilitas</h4>
          <div class="row">
            <div class="col-md-6">
              <ul class="list-unstyled text-muted">
                <li class="mb-2"><i class="fa fa-wifi text-secondary w-1rem mr-3 text-center"></i> <span
                    class="text-sm">Wifi</span></li>
                <li class="mb-2"><i class="fa fa-tv text-secondary w-1rem mr-3 text-center"></i> <span
                    class="text-sm">Cable TV</span></li>
                <li class="mb-2"><i class="fa fa-snowflake text-secondary w-1rem mr-3 text-center"></i> <span
                    class="text-sm">Air conditioning</span></li>
                <li class="mb-2"><i class="fa fa-thermometer-three-quarters text-secondary w-1rem mr-3 text-center"></i>
                  <span class="text-sm">Heating</span></li>
              </ul>
            </div>
            <div class="col-md-6">
              <ul class="list-unstyled text-muted">
                <li class="mb-2"><i class="fa fa-bath text-secondary w-1rem mr-3 text-center"></i><span
                    class="text-sm">Toiletteries</span></li>
                <li class="mb-2"><i class="fa fa-utensils text-secondary w-1rem mr-3 text-center"></i><span
                    class="text-sm">Equipped Kitchen</span></li>
                <li class="mb-2"><i class="fa fa-laptop text-secondary w-1rem mr-3 text-center"></i><span
                    class="text-sm">Desk for work</span></li>
                <li class="mb-2"><i class="fa fa-tshirt text-secondary w-1rem mr-3 text-center"></i><span
                    class="text-sm">Washing machine</span></li>
              </ul>
            </div>
          </div>
        </div>
        <div class="text-block">
          <div class="media"><img src="assets/img/avatar/avatar-0.png" alt="Dzun Nurroin" class="avatar avatar-lg mr-4">
            <div class="media-body">
              <p> <span class="text-muted text-uppercase text-sm">Hosted by </span>
                <br>
                <strong>Dzun Nurroin</strong>
              </p>
              <p class="text-muted text-sm mb-2">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do
                eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud
                exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in
                reprehenderit in voluptate velit esse cillum dolore.</p>
              <p class="text-muted text-sm">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                tempor incididunt ut labore et dolore magna aliqua. </p>
            </div>
          </div>
        </div>
        <div class="text-block">
          <h5 class="mb-4">Gallery</h5>
          <div class="row gallery mb-3 ml-n1 mr-n1">
            <div class="col-lg-4 col-6 px-1 mb-2"><a href="{{ asset('uploads/kursus/'.$kursus->gambar_kursus) }}"
                data-fancybox="gallery" title="Our street"><img
                  src="{{ asset('uploads/kursus/'.$kursus->gambar_kursus) }}" alt="..." class="img-fluid"></a></div>
            <div class="col-lg-4 col-6 px-1 mb-2"><a href="assets/imgimg/photo/photo-1512917774080-9991f1c4c750.jpg"
                data-fancybox="gallery" title="Outside"><img src="assets/img/photo/photo-1512917774080-9991f1c4c750.jpg"
                  alt="..." class="img-fluid"></a></div>
            <div class="col-lg-4 col-6 px-1 mb-2"><a href="assets/imgimg/photo/photo-1494526585095-c41746248156.jpg"
                data-fancybox="gallery" title="Rear entrance"><img
                  src="assets/img/photo/photo-1494526585095-c41746248156.jpg" alt="..." class="img-fluid"></a></div>
            <div class="col-lg-4 col-6 px-1 mb-2"><a href="assets/img/photo/photo-1484154218962-a197022b5858.jpg"
                data-fancybox="gallery" title="Kitchen"><img src="assets/img/photo/photo-1484154218962-a197022b5858.jpg"
                  alt="..." class="img-fluid"></a></div>
            <div class="col-lg-4 col-6 px-1 mb-2"><a href="assets/img/photo/photo-1522771739844-6a9f6d5f14af.jpg"
                data-fancybox="gallery" title="Bedroom"><img src="assets/img/photo/photo-1522771739844-6a9f6d5f14af.jpg"
                  alt="..." class="img-fluid"></a>
            </div>
            <div class="col-lg-4 col-6 px-1 mb-2"><a href="assets/img/photo/photo-1488805990569-3c9e1d76d51c.jpg"
                data-fancybox="gallery" title="Bedroom"><img src="assets/img/photo/photo-1488805990569-3c9e1d76d51c.jpg"
                  alt="..." class="img-fluid"></a></div>
          </div>
        </div>
      </div>
      <div class="col-lg-4">
        <div style="top: 100px;" class="p-4 shadow ml-lg-4 rounded sticky-top">
          <p class="text-muted"><span class="text-primary h2">@currency($kursus->biaya_kursus)</span> per bulan</p>
          <hr class="my-4">
          <form id="booking-form" method="post" action="{{ route('order.post') }}" autocomplete="off" class="form">
            @csrf

            @if (Auth::check())
            <input type="hidden" name="id_pendaftar" value="{{ Auth::user()->id }}">
            @endif

            <input type="hidden" name="id_kursus" value="{{ $kursus->id }}">
            <input type="hidden" name="biaya_kursus" value="{{ $kursus->biaya_kursus }}">
            <input type="hidden" name="diskon_kursus" value="{{ ($kursus->diskon_kursus > 0) ? $kursus->diskon_kursus : 0 }}">
            <div class="form-group">
              <label for="diskon" class="form-label">Diskon</label>
              <h3 class="text-danger">{{ $kursus->diskon_kursus }}%</h3>
            </div>
            <div class="form-group">
              @guest
                  @if (Route::has('register'))
                    <button type="submit" id="orderKursusButton" class="btn btn-block" style="background-color: rgb(235, 236, 237); color: rgb(169, 170, 171)">Pesan</button>
                  @endif                      
                  @else
                    <button type="submit" id="orderKursusButton" class="btn btn-primary btn-block">Pesan</button>
              @endguest
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
@endsection
