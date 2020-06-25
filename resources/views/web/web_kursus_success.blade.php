@extends('web.layouts.main')

@section('title','Kursus - ' . Auth::user()->nama_pendaftar )
@section('content')

    <div class="container-fluid py-5 px-lg-5">
        <h4 class="text-info mb-3"> List Kursus {{ Auth::user()->nama_pendaftar }}</h4>
        <hr>
        <div class="row">

            <div class="col-lg-9">
                <div class="row">

                    @forelse ($kursus_success as $row)

                    {{-- @if ($row->status == "SUCCESS") --}}

                    @foreach ($row->order as $item)

                    {{-- @if ($item->status_kursus == "SUCCESS") --}}

                    @foreach ($row->kursus as $cours)

                    <div data-marker-id="59c0c8e322f3375db4d89128" class="col-sm-6 col-xl-4 mb-5 hover-animate">
                        <div class="card card-kelas h-100 border-0 shadow">
                            <div class="card-img-top overflow-hidden gradient-overlay">
                                <img src="{{ asset('uploads/kursus/'.$cours->gambar_kursus) }}"
                                    alt="{{ $cours->nama_kursus }}" class="img-fluid" /><a
                                    href="{{ route('user.kursus.kelas',$cours->slug) }}" class="tile-link"></a>
                                <div class="card-img-overlay-bottom z-index-20">
                                    <div class="media text-white text-sm align-items-center">

                                        @foreach ($cours->tutor as $tutor)

                                        <img src="{{ asset('uploads/tutor/'.$tutor->foto) }}"
                                            alt="{{ $tutor->nama_tutor }}"
                                            class="avatar-profile avatar-border-white mr-2" />
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
                                        <p class="flex-shrink-1 mb-0 card-stars text-xs text-right"><i
                                                class="fa fa-star text-warning"></i><i
                                                class="fa fa-star text-warning"></i><i
                                                class="fa fa-star text-warning"></i><i
                                                class="fa fa-star text-warning"></i><i class="fa fa-star text-gray-300">
                                            </i>
                                        </p>
                                    </div>
                                    <span class="badge badge-success text-light float-right"><i
                                            class="fas fa-check-circle"></i> Aktif</span>
                                    {{-- <p class="card-text text-muted"><span class="h5 text-primary">@currency($row->biaya_kursus)</span> per
                                                        Bulan</p>
                                                    <p class="card-text text-muted">Dipotong diskon <span class="h6 text-danger"> {{ $cours->diskon_kursus }}%</span>
                                    </p> --}}

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

                    {{-- @elseif($item->status_kursus == "PENDING")
                                    @foreach ($row->kursus as $cours)
                                
                                    <div data-marker-id="59c0c8e322f3375db4d89128" class="col-sm-6 col-xl-4 mb-5 hover-animate">
                                        <div class="card card-kelas h-100 border-0 shadow">
                                            <div class="card-img-top overflow-hidden gradient-overlay">
                                                <img src="{{ asset('uploads/kursus/'.$cours->gambar_kursus) }}"
                    alt="{{ $cours->nama_kursus }}" class="img-fluid" /><a
                        href="{{ route('front.detail',$cours->slug) }}" class="tile-link"></a>
                    <div class="card-img-overlay-bottom z-index-20">
                        <div class="media text-white text-sm align-items-center">

                            @foreach ($cours->tutor as $tutor)

                            <img src="{{ asset('uploads/tutor/'.$tutor->foto) }}" alt="{{ $tutor->nama_tutor }}"
                                class="avatar-profile avatar-border-white mr-2" />
                            <div class="media-body">{{ $tutor->nama_tutor }}</div>

                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="card-body d-flex align-items-center">
                    <div class="w-100">
                        <h6 class="card-title"><a href="{{ route('front.detail',$cours->slug) }}"
                                class="text-decoration-none text-dark">{{ $cours->nama_kursus }}</a></h6>
                        <div class="d-flex card-subtitle mb-3">
                            <p class="flex-grow-1 mb-0 text-muted text-sm">{{ $cours->keterangan }}</p>
                            <p class="flex-shrink-1 mb-0 card-stars text-xs text-right"><i
                                    class="fa fa-star text-warning"></i><i class="fa fa-star text-warning"></i><i
                                    class="fa fa-star text-warning"></i><i class="fa fa-star text-warning"></i><i
                                    class="fa fa-star text-gray-300">
                                </i>
                            </p>
                        </div>
                        <span class="badge badge-secondary text-light float-right"><i class="fas fa-spinner"></i></i>
                            Pending</span>
                        <p class="card-text text-muted"><span
                                class="h5 text-primary">@currency($cours->biaya_kursus)</span> per
                            Bulan</p>
                        <p class="card-text text-muted">Dipotong diskon <span class="h6 text-danger">
                                {{ $cours->diskon_kursus }} <i class="fas fa-percent"></i> </span> </p>

                    </div>

                </div>
            </div>
        </div>
        @endforeach

        @endif --}}


        @endforeach

        {{-- @endif --}}

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