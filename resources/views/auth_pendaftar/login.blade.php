@extends('layouts.app')

@section('title','Login Eh-Bimble')
@section('content')

<div class="container-fluid px-3">
    <div class="row min-vh-100">
        <div class="col-md-8 col-lg-6 col-xl-5 d-flex align-items-center">
            <div class="w-100 py-5 px-md-5 px-xl-6 position-relative">
                <div class="mb-5"><img src="{{asset('assets/frontend/img/favicon.png')}}" style="max-width: 4rem;" class="img-fluid mb-3">
                 
                    <h3>Selamat Datang,Silahkan Login</h3>
                </div>
                <form class="form-validate" method="POST" action="{{ route('login') }}">
                  @csrf
                    <div class="form-group">
                        <label for="username" class="form-label"> Email</label>
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="Masukkan Email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                    </div>
                    <div class="form-group mb-4">
                        <div class="row">
                            <div class="col">
                                <label for="password" class="form-label"> Password</label>
                            </div>
                            <div class="col-auto">
                              @if (Route::has('password.request'))
                              <a href="{{ route('password.request') }}" class="form-text small">Lupa Passwords?</a>
                              @endif
                            </div>
                        </div>
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Masukkan Password">

                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <!-- Submit-->
                    <button type="submit" class="btn btn-lg btn-block btn-primary">Login</button>
                    <hr class="my-4">
                    <p class="text-center"><small class="text-muted text-center">Belum Punya akun Eh-Bimbel? <a
                                href="/register">Daftar Sekarang </a></small></p>
                </form><a href="index.html" class="close-absolute mr-md-5 mr-xl-6 pt-5">
                    <svg class="svg-icon w-3rem h-3rem">
                        <use xlink:href="#close-1"> </use>
                    </svg></a>
            </div>
        </div>
        <div class="col-md-4 col-lg-6 col-xl-7 d-none d-md-block">
            <!-- Image-->
            <div style="background-image: url({{asset('assets/frontend/img/photo/photo-login.jpg')}});"
                class="bg-cover h-100 mr-n3"></div>
        </div>
    </div>
</div>

@endsection
