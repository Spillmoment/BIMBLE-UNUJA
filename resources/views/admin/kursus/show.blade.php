@extends('admin.layouts.main')

@section('title','Admin - Detail Data Kursus')

@section('content')
    
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Detail Data Kursus </h1>
        </div>

            @if(session('status'))
            <div class="alert alert-success" role="alert">
                <strong>{{session('status')}}</strong>
            </div> 
            @endif
     
     
        <div class="row" style="overflow: scroll">
            <div class="col-md-12">
                <div class="container bg-white p-4"
                    style="border-radius:3px;box-shadow:rgba(0, 0, 0, 0.03) 0px 4px 8px 0px">
                    
                    <div class="card shadow" style="width: 50rem; font-size: 15px">
                     <div class="card-body">
                        <h5 class="card-title">Detail Data Kursus </h5>
                        
                      </div>
                      <ul class="list-group list-group-flush">
                      <li class="list-group-item">Nama Kursus : <b>{{ $kursus->nama_kursus }}</b></li>
                        <li class="list-group-item">Gambar Kursus : 
                        <img class="card-img-top" src="{{ asset('uploads/kursus/'.$kursus->gambar_kursus) }}" alt="Card image cap" style="width: 8rem" >
                  
                        <span class="badge badge-pill badge-primary mt-5"  data-toggle="modal" data-target="#exampleModal"><i class="fa fa-eye" aria-hidden="true"></i> Lihat Gambar </span>
                        </li>
                        @foreach ($kursus->kategori as $krs)
                        <li class="list-group-item">Kategori Kursus : <b>{{ $krs->nama_kategori }}</b></li>
                        @endforeach
                        @foreach ($kursus->tutor as $tutor)
                        <li class="list-group-item">Tutor Kursus : <b> {{$tutor->nama_tutor}} </b> </li>
                        @endforeach
                      <li class="list-group-item">Biaya Kursus : <b>{{$kursus->biaya_kursus}}</b></li>  
                      <li class="list-group-item">Diskon Kursus : <b>{{$kursus->diskon_kursus}} %</b></li>  
                      <li class="list-group-item">Lama Kursus : <b>{{$kursus->lama_kursus}} Hari</b></li>
                      <li class="list-group-item">Latitude : <b>{{$kursus->latitude}}</b></li>
                      <li class="list-group-item">Longitude : <b>{{$kursus->longitude}}</b></li>
                      <li class="list-group-item">Keterangan : <b>{{$kursus->keterangan}}</b></li>
                       
                      </ul>
                      <div class="card-body">
                      <a href="{{ route('kursus.index') }}" class="card-link btn btn-primary text-light">  <i class="fa fa-chevron-left" aria-hidden="true"></i> Kembali</a>
                        
                      </div>
                    </div>
                    <div class="text-center">

        
                    </div>
                        
                </div>
            </div>
        </div>
</div>
</div>
</div>


<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Gambar Kursus</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <img class="card-img-top" src="{{ asset('uploads/kursus/'.$kursus->gambar_kursus) }}" alt="Card image cap">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

@endsection