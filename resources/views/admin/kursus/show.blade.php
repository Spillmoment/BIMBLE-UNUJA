@extends('admin.layouts.manager')

@section('title','Bimble - Detail Kursus')
@section('content')
    <div class="orders">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-body">
              <h4 class="box-title">Detail Kursus {{ $kursus->nama_kursus }}</h4>

                      <ul class="list-group list-group-flush">
                      <li class="list-group-item">Nama Kursus : <b>{{ $kursus->nama_kursus }}</b></li>
                        <li class="list-group-item">Gambar Kursus : 
                        <img class="card-img-top" src="{{ asset('uploads/kursus/'.$kursus->gambar_kursus) }}" alt="Card image cap" style="width: 8rem" >
                  
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
                  </div>
                </div>
              </div>
            </div>
          </div>
                   

@endsection