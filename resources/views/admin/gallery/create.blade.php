@extends('admin.layouts.main')

@section('title','Admin - Tambah Data Gallery')

@section('content')

  <div class="main-content">
        <div class="container mt-5">
            <div class="row">
                <div class="col-12 col-sm-10 offset-sm-1 col-md-8 offset-md-2 col-lg-8 offset-lg-2 col-xl-8 offset-xl-2">

                    <div class="card card-primary">
                        <div class="col-md-12 text-center">
                            <p class="registration-title font-weight-bold display-4 mt-4" style="font-size: 50px;">
                                Tambah Gallery</p>
                            <p style="line-height:-30px;margin-top:-20px;">Silahkan isi data data yang diperlukan
                                dibawah </p>
                            <hr>
                        </div>

                        <div class="card-body">
                                <div class="col-md-12 bg-white" style="border-radius:3px;box-shadow:rgba(0, 0, 0, 0.03) 0px 4px 8px 0px">
                                    <form method="post" action="{{route('gallery.store')}}" enctype="multipart/form-data">
                                      @csrf
                                     
                                       <div class="form-group">
                                         <label for="kursus_id">Kursus</label>
                                         <select class="form-control" name="kursus_id" id="kursus_id">
                                           <option value=""> --- Pilih Paket Kursus ---</option>
                                         
                                           @foreach ($kursus as $kursus)      
                                         <option value="{{ $kursus->id }}">{{ $kursus->nama_kursus }}</option>
                                           @endforeach
                                          
                                         </select>
                                       </div>
                                        
                                    <div class="form-group">
                                      <label for="image">Image</label>
                                      <input type="file" class="form-control-file" name="image" id="imahe" placeholder="" aria-describedby="fileHelpId">
                                      </div>
                                        
                                       
                                        <button type="submit" class="btn btn-block btn-success">
                                          <big>Tambah  Gallery</big></button>
                                </div>


                            </form>
                        </div>
                    </div>
                 
                </div>
            </div>
        </div>
  </div>
@endsection