@include('admin.layouts.style')


<link rel="shortcut icon" href="{{ asset('assets/frontend/img/favicon.png') }}" type="image/x-icon">
<title> Login | Manager </title>
  <!-- Main Content -->
  <div id="app">
    <section class="section">
        <div class="d-flex flex-wrap align-items-stretch">
            <div class="col-lg-4 col-md-6 col-12 order-lg-1 min-vh-100 order-2 bg-white">
                <div class="p-4 m-3">
                    <a href="#"> <img src="{{ asset('assets/frontend/img/logo.png') }}" alt="logo"
                            width="150" class=" mb-5 mt-2"></a>
                    <h4 class="text-dark font-weight-normal">Selamat datang di <span
                            class="font-weight-bold">Bimble </span>
                    </h4>
                    <p class="text-muted">Sebelum masuk ke halaman admin, anda harus login terlebih dahulu sebagai
                        manager, silahkan isi data dibawah untuk melanjutkan.</p>
                  
                        <form method="post" action="{{ route('manager.login.submit') }}" class="needs-validation"
                        novalidate="">
                       @csrf

                        <div class="form-group">
                            <label for="email">Email</label>
                            <input id="email" type="email" class="form-control" name="email" tabindex="1" required
                                autofocus>
                            <div class="invalid-feedback">
                                Harap isi bidang email
                            </div>
                        </div>
                      
                        <div class="form-group">
                            <div class="d-block">
                                <label for="password" class="control-label">Password</label>
                            </div>
                            <input id="password" type="password" class="form-control" name="password" tabindex="2"
                                required>
                            <div class="invalid-feedback">
                                Harap isi bidang password
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <div class="col-md-12">
                            <div class="checkbox">
                            <input type="checkbox" id="remember"
                            name="remember" {{ old('remember') ? 'checked' : '' }}> <label
                            for="remember">{{ __('Remember Me') }}</label>
                            </div>
                            </div>
                            </div>

                        <div class="form-group text-right">
                            <button type="submit" class="btn btn-block btn-success btn-lg btn-icon icon-right"
                                tabindex="4">
                                Masuk
                            </button>
                            <br>
                            <a class="btn btn-link pl-0" href="{{
                            route('manager.password.request') }}">
                            {{ __('Forgot Your Password?') }}
                            </a>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-lg-8 col-12 order-lg-2 order-1 min-vh-100 background-walk-y position-relative overlay-gradient-bottom"
                data-background="{{ asset('assets/backend/img/unsplash/ss.jpg') }}">
                <div class="absolute-bottom-left index-2">
                    <div class="text-light p-5 pb-2">
                        <div class="mb-5 pb-3">
                            <h1 class="mb-2 display-4 font-weight-bold text-white">Selamat datang!</h1>
                            <h5 class="font-weight-normal text-muted-transparent text-white">Silahkan login untuk
                                masuk ke
                                halaman admin.</h5>
                        </div>
                        Made with <span class="text-danger"> &#10084;</span> by <a class="text-light bb"
                            target="_blank" href="https://njdev.github.io/">NJ Dev</a> - Image by <a
                            class="text-light bb" target="_blank" href="https://unsplash.com">Unsplash</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

@include('admin.layouts.script')