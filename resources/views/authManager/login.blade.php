@include('layouts.style')

<title> Manager | Login </title>
<main class="login-container">
    <div class="container">
        <div class="row page-login d-flex justify-content-center">
            <div class="section-left col-12 col-md-6">
                
                <div class="card card-shadow mt-5" style="width: 30rem">
                    <div class="card-body">
                        <div class="text-center">
                            <img src="{{ asset('assets/frontend/img/logo.png') }}" alt="" class="w-50 mb-2 mt-2" />
                        </div>
                        <div class="text-center auth-logo-text">
                            <h5 class="text-muted mb-4 mt-2">Manager | Silahkan Login</h5>  
                        </div> <!--end auth-logo-text-->  
                        <form method="post" action="{{ route('manager.login.submit') }}">
                         @csrf                           
                             <div class="form-group">
                                <label class="form-label" for="email">Alamat Email</label>
                                <input id="email" type="email" class="form-control form-input " name="email" value="" required autocomplete="email" autofocus placeholder="Masukan Email">
                                 </div>
                            <div class="form-group">
                                <label class="form-label" for="password">Password</label>
                                <input id="password" type="password" class="form-control form-input " name="password" required autocomplete="current-password" placeholder="Masukan Password">
                                
                              </div>
                            <div class="form-group form-check mb-4 mt-4">
                                <input type="checkbox" class="form-check-input" name="remember {{ old('remember') ? 'checked' : '' }}" id="remember" >
                                <label class="form-check-label" for="remember">Remember Me</label>
  
                       <a href="{{route('manager.password.request') }}" class="float-right"><i class="fas fa-lock mr-0"></i><small>Forgot Your Password?</small> </a>
                </div>
                            <button type="submit" class="btn btn-login btn-block">
                                <i class="fas fa-sign-in-alt mr-2"></i>
                                Login
                            </button>
                           
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
  </main>
