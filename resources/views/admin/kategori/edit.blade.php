@extends('admin.layouts.main')

@section('title','Admin - Edit Data Kategori')

@section('content')

  <div class="main-content">
        <div class="container mt-5">
            <div class="row">
                <div class="col-12 col-sm-10 offset-sm-1 col-md-8 offset-md-2 col-lg-8 offset-lg-2 col-xl-8 offset-xl-2">

                    <div class="card card-primary">
                        <div class="col-md-12 text-center">
                            <p class="registration-title font-weight-bold display-4 mt-4" style="font-size: 50px;">
                               Edit Kategori</p>
                            <p style="line-height:-30px;margin-top:-20px;">Silahkan ubah data data yang diperlukan
                                dibawah </p>
                            <hr>
                        </div>

                        <div class="card-body">
                                <div class="col-md-12 bg-white" style="border-radius:3px;box-shadow:rgba(0, 0, 0, 0.03) 0px 4px 8px 0px">
                                    <form method="post" action="{{route('kategori.update',[$kategori->id])}}">
                                      @csrf
                                     @method('PUT')

                                        <div class="form-group ">
                                           <label for="nama_kategori">Nama Kategori</label>
                                            <input type="text" class="form-control {{ $errors->first('nama_kategori') ? 'is-invalid' : '' }}" name="nama_kategori"  id="nama_kategori" value="{{ $kategori->nama_kategori }}"  placeholder="Nama Kategori">
                                               <div class="invalid-feedback">
                                                   {{$errors->first('nama_kategori')}}
                                                </div>
                                            </div>
                                        
                                    
                                        <div class="form-group">
                                            <label for="keterangan">Keterangan</label>
                                            <textarea name="keterangan" id="keterangan" class="form-control {{$errors->first('keterangan') ? "is-invalid" : ""}}">{{old('keterangan') ?
                                              old('keterangan') : $kategori->keterangan}}</textarea>
                                            <div class="invalid-feedback">
                                                {{$errors->first('keterangan')}}
                                             </div>
                                        </div>
                                        
                                 
                                        <div class="form-group">
                                          <label for="my-input">Status</label>                 
                                       
                                        <div class="form-check" style="font-size: 17px">
                                          <label class="form-check-label" for="active">Aktif  </label>
                                          <span class="ml-4">
                                              <input {{ $kategori->status == "ACTIVE" ? "checked" : ""}} value="ACTIVE" name="status" type="radio" class="form-check-input mt-2" id="active">
                                          </span>
                                              
                                          <label class="form-check-label" for="inactive">Nonaktif </label>
                                              <span class="ml-4">
                                              <input {{$kategori->status == "INACTIVE" ? "checked" : ""}} value="INACTIVE" name="status" type="radio" class="form-check-input mt-2" id="inactive">
                                          </span>

                                        </div>
                                       <br>
                                        <button type="submit" class="btn btn-block btn-success">
                                          <big>Ubah  Kategori</big></button>
                                </div>

                              </div>
                            </form>
                        </div>
                    </div>
                 
                </div>
            </div>
        </div>
  </div>
@endsection