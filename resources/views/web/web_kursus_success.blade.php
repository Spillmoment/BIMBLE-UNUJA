@extends('web.layouts.main')

@section('title','Kursus - ' . Auth::user()->nama_pendaftar )
@section('content')

    <div class="container-fluid py-5 px-lg-5">
        <h5 class="text-dark mb-3"> Daftar Kursus {{ Auth::user()->nama_pendaftar }}</h5>
        <hr>
        <div class="row">

            <div class="col-lg-9">
                <div class="row">
                    @forelse ($kursus_success as $row)
                    @foreach ($row->kursus as $cours)

                    <div data-marker-id="59c0c8e322f3375db4d89128" class="col-sm-6 col-xl-4 mb-5 hover-animate">
                        <div class="card card-kelas h-100 border-0 shadow">
                            <div class="card-img-top overflow-hidden gradient-overlay">
                                <img src="{{ Storage::url('public/'.$cours->gambar_kursus) }}"
                                    alt="{{ $cours->nama_kursus }}" class="img-fluid" /><a
                                    href="{{ route('user.kursus.kelas',$cours->slug) }}" class="tile-link"></a>
                                <div class="card-img-overlay-bottom z-index-20">
                                    <div class="media text-white text-sm align-items-center">

                                        @foreach ($cours->tutor as $tutor)
                                        <img src="{{ Storage::url('public/'.$tutor->foto) }}"
                                            alt="{{ $tutor->nama_tutor }}"
                                            class="avatar-profile avatar-border-white mr-2" height="50px"/>
                                        <div class="media-body">{{ $tutor->nama_tutor }}</div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <div class="card-body d-flex align-items-center">
                                <div class="w-100">
                                    <h6 class="card-title"><a href="{{ route('user.kursus.kelas',$cours->slug) }}"
                                            class="text-decoration-none text-dark">{{ $cours->nama_kursus }}</a></h6>
                                    <div class="d-flex card-subtitle mb-3">
                                        <p class="flex-grow-1 mb-0 text-muted text-sm">{{ $cours->keterangan }}</p>
                                        <p class="flex-shrink-1 mb-0 card-stars text-xs text-right">
                                            @php
                                                $minat_kursus = $cours->count() / 10;
                                                $rating = round($minat_kursus * 2 ) / 2;
                                            @endphp

                                                @for($x = 5; $x > 0; $x--)
                                                @php 
                                                    if($rating > 0.5){
                                                        echo '<i class="fa fa-star text-warning"></i>';
                                                    }elseif($rating <= 0 ){
                                                        echo '<i class="fa fa-star text-gray-300"></i>';
                                                    }else{
                                                        echo '<i class="fa fa-star-half text-warning"></i>';
                                                    }
                                                    $rating--;      
                                                    @endphp
                                            @endfor
                                        </p>
                                    </div>
                                    
                                    <span style="width: 45px" class="badge badge-success badge-pill badge-lg float-right">
                                        <i class="fas fa-check-circle"></i>
                                    </span>
                                  
                                    @if ($cours->diskon_kursus == 0)
                                    <p class="card-text text-muted"><span class="h4 text-primary">
                                            @currency($row->biaya_kursus)</span>
                                        per Bulan</p>
                                    @else
                                    <p class="card-text text-muted">
                                        <span class="h4 text-primary"> @currency($cours->biaya_kursus -
                                            ($cours->biaya_kursus * ($cours->diskon_kursus/100)))</span>
                                        per Bulan
                                    </p>
                                    <p class="card-text ">
                                        <strike>
                                            <span class="h6 text-danger">@currency($cours->biaya_kursus)</span>
                                        </strike>
                                        <strong class="ml-2">Diskon</strong> @currency($cours->diskon_kursus)%
                                    </p>

                                    @endif
                                </div>

                            </div>
                        </div>
                    </div>
                    @endforeach
              
            @empty
            <div>
                <h1>Data Kosong</h1>
            </div>
            @endforelse
        </div>
        </div>


    </div>
    </div>

@endsection