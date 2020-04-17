@extends('web.layouts.main')

@section('title','Bimble Home')
    
@section('content')

<section class="py-6 bg-gray-100">
    <div class="container">
        <div class="row mb-5">
            <div class="col-md-8">
                <h4>Rekomendasi Bimble</h4>
            </div>

        </div>


        <div class="row">
            <div class="col-md-12">

                @if (Request::get('nama_kategori'))
                    <div class="alert alert-success" role="alert">
                        <strong>Hasil Pencarian Kategori :<b> {{ $nama_kategori }} </b> </strong>
                    </div>
                @endif

                <div class="owl-carousel">
                    @foreach ($kursus as $krs)
                    <div data-marker-id="59c0c8e322f3375db4d89128" class="w-100 h-100 hover-animate">
                        <div class="card card-kelas h-100 border-0 shadow">
                            <div class="card-img-top overflow-hidden gradient-overlay">
                                <img src="{{asset('storage/'.$krs->gambar_kursus) }}"
                                    alt="Cute Quirky Garden apt, NYC adjacent" class="img-fluid" /><a
                                    href="detail-rooms.html" class="tile-link"></a>
                                <div class="card-img-overlay-bottom z-index-20">
                                    <div class="media text-white text-sm align-items-center">

                                        @foreach ($krs->tutor as $sensei)
                                        <img src="{{asset('storage/'. $sensei->foto) }}" alt="John" class="avatar-profile avatar-border-white mr-2" /> 
                                            <div class="media-body">{{ $sensei->nama_tutor }}</div>
                                            @endforeach
                                    </div>
                                </div>
                            </div>
                            <div class="card-body d-flex align-items-center">
                                <div class="w-100">
                                    <h6 class="card-title"><a href="detail-rooms.html"
                                            class="text-decoration-none text-dark">{{$krs->nama_kursus}}</a></h6>
                                    <div class="d-flex card-subtitle mb-3">
                                        <p class="flex-grow-1 mb-0 text-muted text-sm">
                                            @foreach ($krs->kategori as $item)
                                               
                                            {{$item->nama_kategori}}</p>
                                            @endforeach
                                        <p class="flex-shrink-1 mb-0 card-stars text-xs text-right"><i
                                                class="fa fa-star text-warning"></i><i
                                                class="fa fa-star text-warning"></i><i
                                                class="fa fa-star text-warning"></i><i
                                                class="fa fa-star text-warning"></i><i
                                                class="fa fa-star text-gray-300"> </i>
                                        </p>
                                    </div>
                                    <p class="card-text text-muted"><span class="h4 text-primary">{{$krs->biaya_kursus}}</span>
                                        per Bulan</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 d-lg-flex align-items-center justify-content-end">
                <a href="#" class="text-primary text-sm"> Lihat Semua<i
                        class="fas fa-angle-double-right ml-2"></i></a>
            </div>
        </div>

        <div class="row">
            {{ $kursus->appends(Request::all())->links() }}
        </div>

    </div>
</section>
@endsection