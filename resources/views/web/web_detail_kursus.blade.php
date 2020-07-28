@extends('web.layouts.main')

@section('title', 'Detail Kursus - ' . $kursus->nama_kursus )
@section('content')

<section
    style="background-image: url('{{ $kursus->galleries->count() ? Storage::url($kursus->galleries->first()->image) : '' }}');"
    class="pt-7 pb-5 d-flex align-items-end dark-overlay bg-cover">
    <div class="container overlay-content">
        <div class="d-flex justify-content-between align-items-start flex-column flex-lg-row align-items-lg-end">
            <div class="text-white mb-4 mb-lg-0">
                @foreach ($kursus->kategori as $kat)
                <div class="badge badge-pill badge-transparent px-3 py-2 mb-4">{{ $kat->nama_kategori }}</div>
                @endforeach
                <h1 class="text-shadow verified">{{ $kursus->nama_kursus  }}</h1>
                <p><i class="fa-map-marker-alt fas mr-2"></i> Paiton, Probolinggo</p>
                <p class="mb-0 d-flex align-items-center"><i class="fa fa-xs fa-star text-primary"></i><i
                        class="fa fa-xs fa-star text-primary"></i><i class="fa fa-xs fa-star text-primary"></i><i
                        class="fa fa-xs fa-star text-primary"></i><i class="fa fa-xs fa-star text-gray-200 mr-4"> </i>
                        <a href="{{ route('front.review', $kursus->slug) }}" class="text-light">{{  $review->count() }} Reviews</a>
                </p>
            </div>
        </div>
    </div>
</section>

<div class="container py-5">
    <div class="row">
        <div class="col-lg-8">
            <div class="text-block">
                <h4>Tentang Kelas {{ $kursus->nama_kursus }}</h4>
                <p class="text-muted font-weight-light">{{ $kursus->keterangan }}</p>
            </div>
            <div class="text-block">
                <h4 class="mb-4">Fasilitas</h4>
                <div class="row">
                    <div class="col-md-6">
                        <ul class="list-unstyled text-muted">
                            <li class="mb-2"><i class="fa fa-wifi text-secondary w-1rem mr-3 text-center"></i> <span
                                    class="text-sm">Wifi</span></li>
                            <li class="mb-2"><i class="fa fa-tv text-secondary w-1rem mr-3 text-center"></i> <span
                                    class="text-sm">Cable TV</span></li>
                            <li class="mb-2"><i class="fa fa-snowflake text-secondary w-1rem mr-3 text-center"></i>
                                <span class="text-sm">Air conditioning</span></li>
                            <li class="mb-2"><i
                                    class="fa fa-thermometer-three-quarters text-secondary w-1rem mr-3 text-center"></i>
                                <span class="text-sm">Heating</span></li>
                        </ul>
                    </div>
                    <div class="col-md-6">
                        <ul class="list-unstyled text-muted">
                            <li class="mb-2"><i class="fa fa-bath text-secondary w-1rem mr-3 text-center"></i><span
                                    class="text-sm">Toiletteries</span></li>
                            <li class="mb-2"><i class="fa fa-utensils text-secondary w-1rem mr-3 text-center"></i><span
                                    class="text-sm">Equipped Kitchen</span></li>
                            <li class="mb-2"><i class="fa fa-laptop text-secondary w-1rem mr-3 text-center"></i><span
                                    class="text-sm">Desk for work</span></li>
                            <li class="mb-2"><i class="fa fa-tshirt text-secondary w-1rem mr-3 text-center"></i><span
                                    class="text-sm">Washing machine</span></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="text-block">
                <div class="media">
                    @foreach ($kursus->tutor as $tutor)
                    <img src="{{ Storage::url('public/'.$tutor->foto) }}" alt="{{ $tutor->nama_tutor }}"
                        class="avatar avatar-lg mr-4">
                    <div class="media-body">
                        <p> <span class="text-muted text-uppercase text-sm">Hosted by </span>
                            <br>
                            <strong>{{ $tutor->nama_tutor }}</strong>
                        </p>
                        <p class="text-muted text-sm mb-2">
                            {{ $tutor->keahlian }}
                        </p>
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="text-block">
                <h5 class="mb-4">Gallery</h5>
                <div class="row gallery mb-3 ml-n1 mr-n1">
                    @forelse ($kursus->galleries as $gallery)
                    <div class="col-lg-4 col-6 px-1 mb-2">
                        <a href="{{ Storage::url($gallery->image) }}" data-fancybox="gallery"
                            title="{{ $kursus->nama_kursus }}">
                            <img src="{{ Storage::url($gallery->image) }}" alt="{{ $kursus->nama_kursus }}"
                                class="img-fluid mt-2"></a>
                    </div>
                    @empty
                    <div class="col-lg-4 col-6 px-1 mb-2 alert alert-warning font-weight-bold">
                        Galeri Kosong
                    </div>
                    @endforelse
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div style="top: 100px;" class="p-4 shadow ml-lg-4 rounded sticky-top">

                @if ($kursus->diskon_kursus == 0)
                <p class="text-muted"><span class="text-primary h2">@currency($kursus->biaya_kursus)</span> per bulan
                </p>
                @else
                <p class="text-muted"><span class="text-primary h2">@currency($kursus->biaya_kursus -
                        ($kursus->biaya_kursus * ($kursus->diskon_kursus/100)) )</span> per bulan</p>

                <span class="text-danger h6 font-weight-bold">
                    <strike>
                        @currency($kursus->biaya_kursus)
                    </strike>
                </span>
                @endif


                <hr class="my-4">
                <form id="booking-form" method="post" action="{{ route('order.post', $kursus->slug) }}" autocomplete="off"
                    class="form">
                    @csrf

                    {{-- @if (Auth::check())
                    <input type="hidden" name="id_pendaftar" value="{{ Auth::user()->id }}" contextmenu="">
                    @endif --}}

                    {{-- <input type="hidden" name="id_kursus" value="{{ $kursus->id }}">
                    <input type="hidden" name="biaya_kursus" value="{{ $kursus->biaya_kursus }}">
                    <input type="hidden" name="diskon_kursus" value="{{ ($kursus->diskon_kursus > 0) ? $kursus->diskon_kursus : 0 }}"> --}}
                    <div class="form-group">
                        <label for="diskon" class="form-label">Diskon</label>
                        <h3>{{ $kursus->diskon_kursus }}%</h3>
                    </div>
                    <div class="form-group">
                        @guest
                        @if (Route::has('register'))
                        <button type="submit" id="orderKursusButton" class="btn btn-block"
                            style="background-color: rgb(235, 236, 237); color: rgb(169, 170, 171)">Pesan</button>
                        @endif
                        @else
                        @if ($check_kursus != null)
                        <div class="alert alert-warning" role="alert">
                            <strong>kursus berhasil diambil!</strong> Silahkan lihat pada cart anda
                        </div>
                        @elseif ($check_kursus_sukses)
                        <div class="alert alert-success" role="alert">
                            <a href="/user/kursus/{{ $kursus->slug }}" class="btn btn-success btn-block">Buka</a>
                        </div>
                        @else
                        <button type="submit" id="orderKursusButton" class="btn btn-primary btn-block btn-rounded-md">
                            Pesan
                        </button>
                        @endif
                        @endguest
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


@endsection

@push('scripts')
<script>
    $(document).ready(function () {
        $('.btn-primary').on('click', function () {
            var $this = $(this);
            $('button').css("opacity", 0.4);
            var loadingText =
                '<button class="spinner-grow spinner-grow-sm"></button> Sedang Diproses...';
            if ($(this).html() !== loadingText) {
                $this.data('original-text', $(this).html());
                $this.html(loadingText);
            }
            setTimeout(function () {
                $this.html($this.data('original-text'));
            }, 3000);
        });
    })

</script>
@endpush
