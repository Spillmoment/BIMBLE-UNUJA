
<!DOCTYPE html>
<html lang="en">
  
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>{{ $title }}</title>
  
  @include('web.layouts.style')
  <link
    href="https://fonts.googleapis.com/css?family=Assistant:200,300,400,600,700,800|Playfair+Display:400,400i,700,700i,900,900i&display=swap"
    rel="stylesheet">

</head>

<body>

  <!-- Navbar -->
  <div class="container">
    <nav class="row navbar navbar-expand-lg navbar-light bg-white">
      <div class="navbar-nav ml-auto mr-auto mr-sm-auto mr-lg-0 mr-md-auto">
        <a href="{{ route('front.index') }}" class="navbar-brand">
          <img src="{{ asset('assets/frontend/img/logo.png') }}" alt="">
        </a>
      </div>
      <ul class="navbar-nav mr-auto d-none d-lg-block">
        <li>
          <span class="text-auto">
            <span class="text-muted">
              | &nbsp; belajar bersama kami di kursus bimble
            </span>
          </span>
        </li>
      </ul>

    </nav>
  </div>
  
  
  <main>
    <div class="section-success d-flex align-items-center">
      <div class="col text-center">

        @php
        $order = Session::get('order')
        @endphp
        
        @if (session('order'))
        @forelse($order as $item)
        @foreach ($item->kursus as $cours)
       
        <img width="100px" src="{{ asset('uploads/kursus/' . $cours->gambar_kursus) }}" class="img-fluid img-thumbail">
        
          <h1>Yayy! Success!</h1>
          
          <center>
            <p class="alert alert-success col-7"> 
              Kursus <strong>{{ $cours->nama_kursus }} </strong>  Berhasil diambil
            </p>
          </center>
          <a href="{{ route('front.index') }}" class="btn btn-home-page mt-3 px-5">
            Home
          </a>
          <a href="{{ route('order.view') }}" class="btn btn-cart-page mt-3 px-5">
            Cart
          </a>
          @endforeach
          
          @empty
          @endforelse
          @else
          <h1>Yayy! Order Kosong!</h1>
          <img  width="200px" src="https://cdn.dribbble.com/users/1219289/screenshots/4904617/picker_empty_state_icon_.jpg" class="img-fluid img-thumbail">
          
          <center>
          <p class="alert alert-info col-7 mt-3">
              Kursus belum diambil
            </p>
          </center>
          <a href="{{ route('front.index') }}" class="btn btn-home-page mt-3 px-5">
            Home
          </a>
          <a href="{{ route('order.view') }}" class="btn btn-cart-page mt-3 px-5">
            Cart
          </a>
          @endif

      </div>
    </div>
  </main>
 
  


</body>

</html>