@extends('admin.layouts.manager')

@section('title','Bimble - Edit Data Tutor')
@section('content')
    <div class="card">
      <div class="card-header">
        <strong>Edit Tutor</strong>
      </div>
      <div class="card-body card-block">
                                    <form method="post" enctype="multipart/form-data" action="{{route('tutor.update',[$tutor->id])}}">
                                      @csrf
                                     @method('PUT')

                                     <div class="form-group ">
                                      <label for="nama_tutor">Nama Tutor</label>
                                       <input type="text" class="form-control {{ $errors->first('nama_tutor') ? 'is-invalid' : '' }}" name="nama_tutor"  id="nama_tutor" value="{{ $tutor->nama_tutor }}"  placeholder="Nama tutor">
                                          <div class="invalid-feedback">
                                              {{$errors->first('nama_tutor')}}
                                           </div>
                                       </div>
                                     
                                   <div class="form-group">
                                     <label for="alamat">Alamat</label>
                                     <textarea name="alamat" class="form-control {{ $errors->first('alamat') ? 'is-invalid' : '' }}" id="alamat" rows="3" placeholder="Alamat">{{ $tutor->alamat}}</textarea>
                                     <div class="invalid-feedback">
                                         {{$errors->first('alamat')}}
                                      </div>
                                 </div>
                                   
                                 <div class="form-group ">
                                   <label for="email">Email</label>
                                    <input type="email" class="form-control {{ $errors->first('email') ? 'is-invalid' : '' }}" name="email"  id="email" value="{{$tutor->email}}"  placeholder="Email">
                                       <div class="invalid-feedback">
                                           {{$errors->first('email')}}
                                        </div>
                                    </div>
                                  
                                    <div class="form-group">
                                      <label for="foto">Foto</label>
                                      <small class="text-muted">Current Foto</small>
                                      <img src="{{asset('uploads/tutor/' . $tutor->foto)}}" width="96px"/>
                                      <input type="file" class="form-control-file {{ $errors->first('foto') ? 'is-invalid' : '' }}" name="foto" id="foto">
                                      <small class="text-muted">Kosongkan jika tidak ingin mengubah
                                        foto</small>
                                    </div>
                                    <div class="invalid-feedback">
                                        {{$errors->first('foto')}}
                                     </div>

                                           
                                 <div class="form-group ">
                                   <label for="username">Username</label>
                                    <input type="username" class="form-control {{ $errors->first('username') ? 'is-invalid' : '' }}" name="username"  id="username" value="{{ $tutor->username }}"  placeholder="Username">
                                       <div class="invalid-feedback">
                                           {{$errors->first('username')}}
                                        </div>
                                    </div>
                                    
                                       
                                 <div class="form-group ">
                                   <label for="password">Password</label>
                                    <input type="password" class="form-control {{ $errors->first('password') ? 'is-invalid' : '' }}" name="password"  id="password" value="{{$tutor->password}}"  placeholder="Password">
                                       <div class="invalid-feedback">
                                           {{$errors->first('password')}}
                                        </div>
                                    </div>

                                 <div class="form-group ">
                                   <label for="password">Konfirmasi Password</label>
                                    <input type="password" class="form-control {{ $errors->first('password') ? 'is-invalid' : '' }}" name="konfirmasi_password"  id="password" value="{{ $tutor->konfirmasi_password }}"  placeholder="Password">
                                       <div class="invalid-feedback">
                                           {{$errors->first('konfirmasi_password')}}
                                        </div>
                                    </div>

                                       
                                 <div class="form-group ">
                                   <label for="keahlian">Keahlian</label>
                                    <input type="keahlian" class="form-control {{ $errors->first('keahlian') ? 'is-invalid' : '' }}" name="keahlian"  id="keahlian" value="{{ $tutor->keahlian }}"  placeholder="Keahlian">
                                       <div class="invalid-feedback">
                                           {{$errors->first('keahlian')}}
                                        </div>
                                    </div>

                                    <div class="form-group">
                                      <label for="my-input">Status</label>                 
                                   
                                    <div class="form-check" style="font-size: 17px">
                                      <label class="form-check-label" for="active">Aktif  </label>
                                      <span class="ml-4">
                                          <input {{ $tutor->status == 1 ? "checked" : ""}} value="1" name="status" type="radio" class="form-check-input mt-2" id="active">
                                      </span>
                                          
                                      <label class="form-check-label" for="inactive">Nonaktif </label>
                                          <span class="ml-4">
                                          <input {{$tutor->status == 0 ? "checked" : ""}} value="0" name="status" type="radio" class="form-check-input mt-2" id="inactive">
                                      </span>

                                    </div>
                                  <br>
                                        <button type="submit" class="btn btn-block btn-primary">
                                          <big> <i class="fa fa-edit" aria-hidden="true"></i> Edit Tutor</big></button>
                                </div>


                            </form>
                        </div>
                    </div>
                 
                </div>
            </div>
        </div>
  </div>
@endsection
