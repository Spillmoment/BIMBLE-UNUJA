@extends('web.layouts.main')

@section('title','Bimble Home')
@push('style')
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.6.0/dist/leaflet.css"
    integrity="sha512-xwE/Az9zrjBIphAcBb3F6JVqxf46+CDLwfLMHloNu6KEQCAWi6HcDUbeOfBIptF7tcCzusKFjFw2yuvEpDL9wQ=="
    crossorigin=""/>
    <!-- Make sure you put this AFTER Leaflet's CSS -->
    <script src="https://unpkg.com/leaflet@1.6.0/dist/leaflet.js"
    integrity="sha512-gZwIG9x3wUXg2hdXF6+rVkLF/0Vi9U8D2Ntg4Ga5I5BZpVkVxlJWbSQtXPSiUTtC0TjtGOmxa1AJPuV0CPthew=="
    crossorigin=""></script>
    
    <style>
        #mapid { min-height: 500px; }
    </style>
@endpush
@section('content')

@include('web.layouts.header')

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
                                <img src="{{asset('uploads/kursus/'.$krs->gambar_kursus) }}" style="height: 10em;"
                                    alt="Cute Quirky Garden apt, NYC adjacent" class="img-fluid" /><a
                                    href="{{ route('front.detail', [$krs->slug]) }}" class="tile-link"></a>
                                <div class="card-img-overlay-bottom z-index-20">
                                    <div class="media text-white text-sm align-items-center">

                                        @foreach ($krs->tutor as $sensei)
                                        <img src="{{asset('uploads/tutor/'.$sensei->foto) }}" alt="John" class="avatar-profile avatar-border-white mr-2" /> 
                                            <div class="media-body">{{ $sensei->nama_tutor }}</div>
                                            @endforeach
                                    </div>
                                </div>
                            </div>

                            <div class="card-body d-flex align-items-center">
                                <div class="w-100">
                                    <h6 class="card-title"><a href="{{ route('front.detail', [$krs->slug]) }}"
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

                                    @if ($krs->diskon_kursus == 0)     
                                    <p class="card-text text-muted"><span class="h4 text-primary"> @currency($krs->biaya_kursus)</span>
                                        per Bulan</p>                                        
                                    @else
                                    <p class="card-text text-muted"><span class="h4 text-primary"> @currency($krs->biaya_kursus - $krs->diskon_kursus)</span>
                                        per Bulan</p> 
                                        <strike>
                                        <p class="card-text text-muted"><span class="h6 text-danger"> Diskon: @currency($krs->diskon_kursus)</span>
                                           </p> 
                                    </strike>
                                    @endif

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
            <a href="{{ route('front.kursus') }}" class="text-primary text-sm"> Lihat Semua<i
                        class="fas fa-angle-double-right ml-2"></i></a>
            </div>
        </div>

        <div class="row">
            <div class="col">
                <div id="mapid"></div>
            </div>
        </div>
        
        <div class="row">
            {{ $kursus->appends(Request::all())->links() }}
        </div>

    </div>
</section>
@endsection

@push('scripts')

<script src="{{ asset('js/app.js') }}"></script>
<script>
    var map = L.map('mapid').setView([{{ config('leaflet.map_center_latitude') }}, {{ config('leaflet.map_center_longitude') }}], {{ config('leaflet.zoom_level') }});
    var baseUrl = "{{ url('/') }}";

    L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token={accessToken}', {
        attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, <a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
        maxZoom: 18,
        id: 'mapbox/streets-v11',
        tileSize: 512,
        zoomOffset: -1,
        accessToken: 'pk.eyJ1IjoiZ3VuYXdhbjk4IiwiYSI6ImNrYWN6dmcxczE1M2MyenJ1N2R4MjdsZXYifQ.aLQflQW3Wd-Ei6gQrUtbsw'
    }).addTo(map);

    axios.get('{{ route('api.outlets.index') }}')
    .then(function (response) {
        console.log(response.data);
        L.geoJSON(response.data, {
            pointToLayer: function(geoJsonPoint, latlng) {
                return L.marker(latlng);
            }
        })
        .bindPopup(function (layer) {
            return layer.feature.properties.map_popup_content;
        }).addTo(map);
    })
    .catch(function (error) {
        console.log(error);
    });

    @can('create', new App\Outlet)
    var theMarker;

    map.on('click', function(e) {
        let latitude = e.latlng.lat.toString().substring(0, 15);
        let longitude = e.latlng.lng.toString().substring(0, 15);

        if (theMarker != undefined) {
            map.removeLayer(theMarker);
        };

        var popupContent = "Your location : " + latitude + ", " + longitude + ".";
        popupContent += '<br><a href="{{ route('outlets.create') }}?latitude=' + latitude + '&longitude=' + longitude + '">Add new outlet here</a>';

        theMarker = L.marker([latitude, longitude]).addTo(map);
        theMarker.bindPopup(popupContent)
        .openPopup();
    });
    @endcan

</script>

@endpush