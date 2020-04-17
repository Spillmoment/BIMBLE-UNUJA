@extends('admin.layouts.main')

@section('title','Admin - Tambah Data Tutor')

@section('content')

  <div class="main-content">
        <div class="container mt-5">
            <div class="row">
                <div class="col-12 col-sm-10 offset-sm-1 col-md-8 offset-md-2 col-lg-8 offset-lg-2 col-xl-8 offset-xl-2">

                    <div class="card card-primary">
                        <div class="col-md-12 text-center">
                            <p class="registration-title font-weight-bold display-4 mt-4" style="font-size: 50px;">
                                Tambah Data Tutor</p>
                            <p style="line-height:-30px;margin-top:-20px;">Silahkan isi data data yang diperlukan
                                dibawah </p>
                            <hr>
                        </div>

                        <div class="card-body">
                                <div class="col-md-12 bg-white" style="border-radius:3px;box-shadow:rgba(0, 0, 0, 0.03) 0px 4px 8px 0px">
                                    <form method="post" enctype="multipart/form-data" action="{{route('tutor.store')}}">
                                      @csrf
                                     
                                        <div class="form-group ">
                                           <label for="nama_tutor">Nama Tutor</label>
                                            <input type="text" class="form-control {{ $errors->first('nama_tutor') ? 'is-invalid' : '' }}" name="nama_tutor"  id="nama_tutor" value="{{old('nama_tutor')}}"  placeholder="Nama tutor">
                                               <div class="invalid-feedback">
                                                   {{$errors->first('nama_tutor')}}
                                                </div>
                                            </div>
                                          
                                        <div class="form-group">
                                          <label for="alamat">Alamat</label>
                                          <textarea name="alamat" class="form-control {{ $errors->first('alamat') ? 'is-invalid' : '' }}" id="alamat" rows="3" placeholder="Alamat">{{old('alamat')}}</textarea>
                                          <div class="invalid-feedback">
                                              {{$errors->first('alamat')}}
                                           </div>
                                      </div>
                                        
                                      <div class="form-group ">
                                        <label for="email">Email</label>
                                         <input type="email" class="form-control {{ $errors->first('email') ? 'is-invalid' : '' }}" name="email"  id="email" value="{{old('email')}}"  placeholder="Email">
                                            <div class="invalid-feedback">
                                                {{$errors->first('email')}}
                                             </div>
                                         </div>
                                       
                                            <div class="form-group">
                                              <label for="foto">Foto</label>
                                              <input type="file" class="form-control-file {{ $errors->first('foto') ? 'is-invalid' : '' }}" name="foto" id="foto">
                                            </div>
                                            <div class="invalid-feedback">
                                                {{$errors->first('foto')}}
                                             </div>

                                                
                                      <div class="form-group ">
                                        <label for="username">Username</label>
                                         <input type="username" class="form-control {{ $errors->first('username') ? 'is-invalid' : '' }}" name="username"  id="username" value="{{old('username')}}"  placeholder="Username">
                                            <div class="invalid-feedback">
                                                {{$errors->first('username')}}
                                             </div>
                                         </div>
                                         
                                            
                                      <div class="form-group ">
                                        <label for="password">Password</label>
                                         <input type="password" class="form-control {{ $errors->first('password') ? 'is-invalid' : '' }}" name="password"  id="password" value="{{old('password')}}"  placeholder="Password">
                                            <div class="invalid-feedback">
                                                {{$errors->first('password')}}
                                             </div>
                                         </div>

                                      <div class="form-group ">
                                        <label for="password">Konfirmasi Password</label>
                                         <input type="password" class="form-control {{ $errors->first('password') ? 'is-invalid' : '' }}" name="konfirmasi_password"  id="password" value="{{old('konfirmasi_password')}}"  placeholder="Password">
                                            <div class="invalid-feedback">
                                                {{$errors->first('konfirmasi_password')}}
                                             </div>
                                         </div>

                                            
                                      <div class="form-group ">
                                        <label for="keahlian">Keahlian</label>
                                         <input type="keahlian" class="form-control {{ $errors->first('keahlian') ? 'is-invalid' : '' }}" name="keahlian"  id="keahlian" value="{{old('keahlian')}}"  placeholder="Keahlian">
                                            <div class="invalid-feedback">
                                                {{$errors->first('keahlian')}}
                                             </div>
                                         </div>

                                            
                                        <button type="submit" class="btn btn-block btn-success">
                                          <big>Tambah  Kursus</big></button>
                                </div>


                            </form>
                        </div>
                    </div>
                 
                </div>
            </div>
        </div>
  </div>
@endsection
