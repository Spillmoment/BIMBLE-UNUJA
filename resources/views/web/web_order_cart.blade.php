<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from demo.bootstrapious.com/directory/1-4-1/category-3.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 17 Mar 2020 08:28:58 GMT -->

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Eh-Bimble</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="all,follow">
    @include('web.layouts.style')
    {{-- CDN untuk switch button + cdn jquery --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/switchery/0.8.2/switchery.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/switchery/0.8.2/switchery.min.js"></script>

    {{-- CDN untuk tost --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    {{-- crsf-token Meta --}}
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

<body style="padding-top: 72px;">
    <header class="header">
        <!-- Navbar-->
        <nav class="navbar navbar-expand-lg fixed-top shadow navbar-light bg-white">
            <div class="container-fluid">
                <div class="d-flex align-items-center"><a href="{{route('front.index')}}" class="navbar-brand py-1">
                        <img src="{{asset('assets/frontend/img/logo.png') }}" alt="Directory logo" style="width: 150px;"></a>

                        
                    <form action="#" id="search" class="form-inline d-none d-sm-flex">
                        <div
                            class="input-label-absolute input-label-absolute-left input-reset input-expand ml-lg-2 ml-xl-3">
                            <label for="search_search" class="label-absolute"><i class="fa fa-search"></i><span
                                    class="sr-only">What
                                    are you looking for?</span></label>
                            <input id="search_search" placeholder="Search" aria-label="Search"
                                class="form-control form-control-sm border-0 shadow-0 bg-gray-200">
                            <button type="reset" class="btn btn-reset btn-sm"><i class="fa-times fas"></i></button>
                        </div>
                    </form>

                </div>
                <button type="button" data-toggle="collapse" data-target="#navbarCollapse"
                    aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation"
                    class="navbar-toggler navbar-toggler-right"><i class="fa fa-bars"></i></button>
                <!-- Navbar Collapse -->
                <div id="navbarCollapse" class="collapse navbar-collapse">
                    <ul class="navbar-nav ml-auto">
                        @guest
                        <li class="nav-item"><a href="#" class="nav-link active">Beranda</a></li>
                        <li class="nav-item"><a href="#" class="nav-link active">Pusat Bantuan</a></li>
                        @if (Route::has('register'))
                            <li class="nav-item"><a href="{{ route('login') }}" class="nav-link">Sign in</a></li>
                            <li class="nav-item"><a href="{{ route('register') }}" class="nav-link">Sign up</a></li>
                        @endif
                        @else
                            <li class="nav-item"><a href="#" class="nav-link active">Beranda</a></li>
                            <li class="nav-item"><a href="#" class="nav-link active">Pusat Bantuan</a></li>
                            <li class="nav-item"><a href="#" class="nav-link">{{ Auth::user()->nama_pendaftar }}</a></li>
                            <li class="nav-item"><a href="{{ route('user.logout') }}" class="nav-link">Log out</a></li>
                        
                            
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>
        <!-- /Navbar -->
    </header>
    <div class="container-fluid py-5 px-lg-5">
        <!-- <div class="row border-bottom mb-4">
            <div class="col-12">
                <h1 class="display-4 font-weight-bold text-serif mb-4">Eat in Manhattan, NY</h1>
            </div>
        </div> -->
        <div class="row">
            <div class="col-lg-3 pt-3">
                <form action="#" class="pr-xl-3">
                    <div class="mb-4">
                        <label for="form_search" class="form-label">Card Number</label>
                        <div class="input-label-absolute input-label-absolute-right">
                            <input type="search" name="search" placeholder="Card" id="form_search"
                                class="form-control pr-4">
                        </div>
                    </div>
                    <div class="pb-4">
                        <div class="mb-4">
                            <button type="submit" class="btn btn-primary"> <i class="fas fa-credit-card mr-1"></i>Pay Now
                            </button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-lg-9">
                <div class="d-flex justify-content-between align-items-center flex-column flex-md-row mb-4">
                    <div class="mr-3">
                        <p class="mb-3 mb-md-0"><strong>12</strong> results found</p>
                    </div>
                    <div>
                        <label for="form_sort" class="form-label mr-2">Sort by</label>
                        <select name="sort" id="form_sort" data-style="btn-selectpicker" title="" class="selectpicker">
                            <option value="sortBy_0">Most popular </option>
                            <option value="sortBy_1">Recommended </option>
                            <option value="sortBy_2">Newest </option>
                            <option value="sortBy_3">Oldest </option>
                            <option value="sortBy_4">Closest </option>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <!-- venue item-->
                    @foreach ($order_kursus as $item)
                        @foreach ( $item->kursus as $cours )
                    <div data-marker-id="59c0c8e322f3375db4d89128" class="col-sm-6 col-xl-4 mb-5 hover-animate">
                        <div class="card card-kelas h-100 border-0 shadow">
                            <div class="card-img-top overflow-hidden gradient-overlay">
                                <img src="{{ asset('uploads/kursus/'.$cours->gambar_kursus) }}"
                                    alt="Cute Quirky Garden apt, NYC adjacent" class="img-fluid" /><a
                                    href="detail-kursus.html" class="tile-link"></a>
                                <div class="card-img-overlay-bottom z-index-20">
                                    <div class="media text-white text-sm align-items-center">
                                        <img src="{{ asset('assets/frontend/img/avatar/avatar-0.png') }}" alt="John" class="avatar-profile avatar-border-white mr-2" />
                                        <div class="media-body">Dzun</div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body d-flex align-items-center">
                                <div class="w-100">
                                    <h6 class="card-title"><a href="detail-kursus.html" class="text-decoration-none text-dark">{{ $cours->nama_kursus }}</a></h6>
                                    <div class="d-flex card-subtitle mb-3">
                                        <p class="flex-grow-1 mb-0 text-muted text-sm">Untuk SMA sederajat</p>
                                        <p class="flex-shrink-1 mb-0 card-stars text-xs text-right"><i
                                                class="fa fa-star text-warning"></i><i
                                                class="fa fa-star text-warning"></i><i
                                                class="fa fa-star text-warning"></i><i
                                                class="fa fa-star text-warning"></i><i class="fa fa-star text-gray-300">
                                            </i>
                                        </p>
                                    </div>
                                    <p class="card-text text-muted"><span class="h5 text-primary">Rp {{ $item->biaya_kursus }}</span> per
                                        Bulan</p>
                                    <p class="card-text text-muted">Dipotong diskon <span class="h6 text-danger">Rp {{ $cours->diskon_kursus }}</span> </p>
                                    <input type="checkbox" data-id="{{ $item->id }}" data-order="{{ $item->id_order }}" data-pendaf="{{ $item->id_pendaftar }}" data-kursus="{{ $cours->nama_kursus }}" name="status" class="js-switch" {{ $item->status == 'PROCESS' ? 'checked' : '' }}>
                                    
                                    {{-- <button type="button" class="btn btn-danger btn-sm deleteCart" data-id="{{ $item->id }}" data-orderId="{{ $item->id_order }}" data-biaya="{{ $item->biaya_kursus }}">Hapus</button> --}}
                                    <button id="deleteCart" class="btn btn-danger btn-sm" data-id="{{ $item->id }}">Hapus</button>
                                </div>
                            </div>
                        </div>
                    </div>
                        @endforeach
                    @endforeach
                </div>
                <!-- Pagination -->
                <h5>Total tagihan Anda : Rp. <span id="total">{{ $total_tagihan }}</span></h5>
            </div>
        </div>
    </div>
    
    @include('web.layouts.footer')
    
    @include('web.layouts.script')

</body>

<script>

    let elems = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));
    elems.forEach(function(html) {
        let switchery = new Switchery(html,  { size: 'small' });
    });

    $(document).ready(function(){
        $('.js-switch').change(function () {
            let status = $(this).prop('checked') === true ? 'PROCESS' : 'CANCEL';
            let orderId = $(this).data('id');
            let orderFk = $(this).data('order');
            let pendaftarId = $(this).data('pendaf');
            let namaKursus = $(this).data('kursus');
            $.ajax({
                type: "GET",
                dataType: "json",
                url: '{{ route('order.update.cancel') }}',
                data: {'status': status, 'order_id': orderId, 'order_fk': orderFk, 'id_pendaftar': pendaftarId, 'nama_kursus': namaKursus},
                success: function (data) {
                    toastr.options.closeButton = true;
                    toastr.options.closeMethod = 'fadeOut';
                    toastr.options.closeDuration = 100;
                    toastr.success(data.message);

                    document.getElementById("total").textContent=data.totalTagihan;
                }
            });
        });

        $("body").on("click","#deleteCart",function(e){

            if(!confirm("Hapus pesanan ini?")) {
                return false;
            }

            e.preventDefault();
            var id = $(this).data("id");
            var token = $("meta[name='csrf-token']").attr("content");

            $.ajax({
                url: "/order/cart/"+id,
                type: 'DELETE',
                data: {
                    _token: token,
                        id: id
                },
                success: function (response){
                    toastr.options.closeButton = true;
                    toastr.options.closeMethod = 'fadeOut';
                    toastr.options.closeDuration = 100;
                    toastr.warning(response.message);

                    document.getElementById("total").textContent=response.totalTagihan;
                    setTimeout(function(){
                        location.reload(); 
                    }, 1500); 
                }
            });
        
            return false;
        });
        
    });
    
</script>

</html>