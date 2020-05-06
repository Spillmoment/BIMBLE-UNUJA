@extends('admin.layouts.main')

@section('title','Admin - Tambah Data Kursus')

@section('content')

  <div class="main-content">
        <div class="container mt-5">
            <div class="row">
                <div class="col-12 col-sm-10 offset-sm-1 col-md-8 offset-md-2 col-lg-8 offset-lg-2 col-xl-8 offset-xl-2">
                  
                    <div class="card card-primary">
                      
                        <div class="col-md-12 text-center">
                            <nav class="breadcrumb ml-4 mt-3" style="margin-top: -20px">
                                <a class="breadcrumb-item" href="{{ route('manager.home') }}">Home</a>
                            <a class="breadcrumb-item" href="{{ route('kursus.index') }}">Kursus</a>
                            <a class="breadcrumb-item active" href="#">Tambah Kursus</a>
                            </nav>
                            <p class="registration-title font-weight-bold display-4 mt-4" style="font-size: 50px;">
                                Tambah Data Kursus</p>
                            <p style="line-height:-30px;margin-top:-20px;">Silahkan isi data data yang diperlukan
                                dibawah </p>
                            <hr>
                        </div>

                        <div class="card-body">
                                <div class="col-md-12 bg-white" style="border-radius:3px;box-shadow:rgba(0, 0, 0, 0.03) 0px 4px 8px 0px">
                                    <form method="post" enctype="multipart/form-data" action="{{route('kursus.store')}}">
                                      @csrf
                                     
                                        <div class="form-group ">
                                           <label for="nama_kursus">Nama Kursus</label>
                                            <input type="text" class="form-control {{ $errors->first('nama_kursus') ? 'is-invalid' : '' }}" name="nama_kursus"  id="nama_kursus" value="{{old('nama_kursus')}}"  placeholder="Nama Kursus">
                                               <div class="invalid-feedback">
                                                   {{$errors->first('nama_kursus')}}
                                                </div>
                                            </div>
                                        
                                            <div class="form-group">
                                              <label for="gambar_kursus">Gambar Kursus</label>
                                              <input type="file" class="form-control-file {{ $errors->first('gambar_kursus') ? 'is-invalid' : '' }}" name="gambar_kursus" id="gambar_kursus">
                                            </div>
                                            <div class="invalid-feedback">
                                                {{$errors->first('gambar_kursus')}}
                                             </div>
                                         
                                             <div class="form-group">
                                               <label for="kategori">Kategori Kursus</label>
                                               <select class="form-control  {{ $errors->first('id_kategori') ? 'is-invalid' : '' }}" name="id_kategori" id="id_kategori">
                                                   @foreach ($kategori as $kt)
                                               <option value="{{ $kt->id }}">{{ $kt->nama_kategori }}</option>
                                                   @endforeach
                                                </select>
                                             </div>
                                             <div class="invalid-feedback">
                                                {{$errors->first('id_kategori')}}
                                             </div>

                                             <div class="form-group">
                                               <label for="tutor">Tutor Kursus</label>
                                               <select class="form-control  {{ $errors->first('id_tutor') ? 'is-invalid' : '' }}" name="id_tutor" id="id_tutor">
                                                   @foreach ($tutor as $kt)
                                               <option value="{{ $kt->id }}">{{ $kt->nama_tutor }}</option>
                                                   @endforeach
                                                </select>
                                             </div>
                                             <div class="invalid-feedback">
                                                {{$errors->first('id_tutor')}}
                                             </div>

                                         <div class="form-group ">
                                            <label for="biaya_kursus">Biaya Kursus</label>
                                             <input type="number" class="form-control {{ $errors->first('biaya_kursus') ? 'is-invalid' : '' }}" name="biaya_kursus"  id="biaya_kursus" value="{{old('biaya_kursus')}}"  placeholder="Biaya Kursus">
                                                <div class="invalid-feedback">
                                                    {{$errors->first('biaya_kursus')}}
                                                 </div>
                                             </div>
                                         
                                         <div class="form-group ">
                                            <label for="diskon_kursus">Diskon Kursus</label>
                                             <input type="number" class="form-control {{ $errors->first('diskon_kursus') ? 'is-invalid' : '' }}" name="diskon_kursus"  id="diskon_kursus" value="{{old('diskon_kursus')}}"  placeholder="Diskon Kursus">
                                                <div class="invalid-feedback">
                                                    {{$errors->first('diskon_kursus')}}
                                                 </div>
                                             </div>
                                        
                                         <div class="form-group ">
                                            <label for="lama_kursus">Lama Kursus</label>
                                             <input type="text" class="form-control {{ $errors->first('lama_kursus') ? 'is-invalid' : '' }}" name="lama_kursus"  id="lama_kursus" value="{{old('lama_kursus')}}"  placeholder="Lama Kursus">
                                                <div class="invalid-feedback">
                                                    {{$errors->first('lama_kursus')}}
                                                 </div>
                                             </div>

                                         <div class="form-group ">
                                            <label for="latitude">Latitude</label>
                                             <input type="number" class="form-control {{ $errors->first('latitude') ? 'is-invalid' : '' }}" name="latitude"  id="latitude" value="{{old('latitude')}}"  placeholder="Latitude">
                                                <div class="invalid-feedback">
                                                    {{$errors->first('latitude')}}
                                                 </div>
                                             </div>
                                         
                                         <div class="form-group ">
                                            <label for="longitude">Longitude</label>
                                             <input type="number" class="form-control {{ $errors->first('longitude') ? 'is-invalid' : '' }}" name="longitude"  id="longitude" value="{{old('longitude')}}"  placeholder="Longitude">
                                                <div class="invalid-feedback">
                                                    {{$errors->first('longitude')}}
                                                 </div>
                                             </div>
                                         
                                      
                                             <div class="form-group">
                                                <label for="keterangan">Keterangan</label>
                                                <textarea name="keterangan" class="form-control {{ $errors->first('keterangan') ? 'is-invalid' : '' }}" id="keterangan" rows="3" placeholder="Keterangan">{{old('keterangan')}}</textarea>
                                                <div class="invalid-feedback">
                                                    {{$errors->first('keterangan')}}
                                                 </div>
                                            </div>
                                       
                                        <button type="submit" class="btn btn-block btn-success">
                                          <big> <i class="fa fa-plus" aria-hidden="true"></i> Tambah  Kursus</big></button>
                                </div>


                            </form>
                        </div>
                    </div>
                 
                </div>
            </div>
        </div>
  </div>
@endsection
