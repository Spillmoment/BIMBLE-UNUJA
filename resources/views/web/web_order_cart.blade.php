<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="shortcut icon" href="{{asset('assets/frontend/img/favicon.png') }}" type="image/x-icon">
    <title>Bimble | Halaman Pesanan</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="all,follow">
    @include('web.layouts.style')
    {{-- CDN untuk switch button + cdn jquery --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/switchery/0.8.2/switchery.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/switchery/0.8.2/switchery.min.js"></script>

    {{-- CDN untuk toast --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    {{-- crsf-token Meta --}}
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

<body style="padding-top: 72px;">
    {{-- @include('web.layouts.style') --}}
    @include('web.layouts.header')
    
    <section class="py-5">
        <div class="container-fluid">
            <div class="d-flex justify-content-between align-items-center flex-column flex-lg-row mb-5">
                <div class="mr-3">
                    <p class="mb-3 mb-lg-0 ml-4">Anda memiliki
    
                        @if ($order_kursus != null)
                        <strong>{{ $order_kursus->count() }} Pesanan Kursus</strong>
                        @else
                        <strong>0 Pesanan Kursus</strong>
                        @endif
    
                    </p>
                </div>
            </div>
            <div class="container-fluid mb-4">
                <div class="row">
    
                    <div class="col-9 mb-5">
    
                        @if (session('status'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                <span class="sr-only">Close</span>
                            </button>
                            <span>{{ session('status') }} </span>
                        </div>
                        @endif
    
                        <div class="card shadow">
                            <ul class="nav nav-pills mb-3 mx-3 my-3" id="pills-tab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home"
                                        role="tab" aria-controls="pills-home" aria-selected="true">Daftar Pesanan</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile"
                                        role="tab" aria-controls="pills-profile" aria-selected="false">Status Pesanan</a>
                                </li>
    
                            </ul>
    
                            <div class="tab-content" id="pills-tabContent">
                                {{-- Daftar Pesanan --}}
                                <div class="tab-pane fade show active" id="pills-home" role="tabpanel"
                                    aria-labelledby="pills-home-tab">
                                    <div class="table-responsive">
                                        <table class="table table-responsive">
                                            <thead>
                                                <tr class="text-sm">
                                                    <th scope="col"> </th>
                                                    <th scope="col" width="400">Kursus</th>
                                                    <th scope="col" width="180">Mentor</th>
                                                    <th scope="col" class="text-right">Harga</th>
                                                    <th> Cancel</th>
                                                    <th> Option</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @forelse($order_kursus as $item)
                                                @foreach ( $item->kursus as $cours )
                                                <tr>
                                                    <td><img width="100px"
                                                            src="{{ Storage::url('public/'.$cours->gambar_kursus) }}"
                                                            alt="{{ $cours->nama_kursus }}" /> </td>
                                                    <td>{{ $cours->nama_kursus }}</td>
                                                    <td>{{ $cours->tutor->first()->nama_tutor }}</td>
                                                    </td>
                                                    <td> @currency($cours->biaya_kursus -
                                                        ($cours->biaya_kursus * ($cours->diskon_kursus/100)))</td>
                                                    <td> <input type="checkbox" data-id="{{ $item->id }}" data-order="{{ $item->id_order }}"
                                                        data-pendaf="{{ $item->id_pendaftar }}" data-kursus="{{ $cours->nama_kursus }}"
                                                        name="status" class="js-switch" {{ $item->status == 'PROCESS' ? 'checked' : '' }}> </td>
                                                    <td class="text-right"><button class="btn btn-sm btn-danger" id="deleteCart" data-id="{{ $item->id }}"><i class="fa fa-trash"></i> </button> </td>
                                                </tr>
                                                @endforeach
                                                @empty
                                              <table>
                                                  <tbody>
                                                    <div class="alert alert-warning text-sm mb-3 mt-3 col">
                                                        <div class="media align-items-center">
                                                          <div class="media-body text-center ">Pesanan <strong>kursus</strong> anda kosong </div>
                                                        </div>
                                                      </div>
                                                  </tbody>
                                              </table>
                                                @endforelse
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="card-body border-top">
                                        Total Tagihan:
                                        @if ($total_tagihan != 0)
                                        <span class="font-weight-bold" id="total">
                                            @currency($total_tagihan)
                                        </span>
                                        @else
                                        0
                                        @endif
                                    </div>
                                </div>
    
    
                                {{-- Tab Status Pesanan --}}
                                <div class="tab-pane fade ml-3" id="pills-profile" role="tabpanel"
                                    aria-labelledby="pills-profile-tab">
    
                                    @forelse($order as $pesan)
                                    @if ($pesan->status_kursus == 'PENDING')
                                    <span id="deleteCheckout" data-id="{{ $pesan->id }}"
                                        class="badge badge-danger align-self-start" style="cursor: pointer">x</span>
                                    <div class="card card-shadow mx-3 my-3" style="max-width: 540px;">
                                        <div class="row no-gutters">
                                            <div class="col-md-4">
                                                <img src="{{ asset('storage/uploads/bukti_pembayaran/'.$pesan->upload_bukti) }}"
                                                    class="img-fluid img-thumbail card-img" alt="...">
                                            </div>
                                            <div class="col-md-8">
                                                <div class="card-body">
                                                    <h5 class="card-title">Menunggu Konfirmasi</h5>
                                                    <p class="card-text">
                                                        List kursus
                                                        <ul>
                                                            @foreach ($kursus_state as $list_kursus)
                                                            <li>{{ $list_kursus->kursus->first()->nama_kursus }}
                                                            </li>
                                                            @endforeach
                                                        </ul>
                                                    </p>
                                                    <p class="card-text"><small class="text-muted">Pesanan
                                                            {{ $pesan->updated_at->diffForHumans() }}</small></p>
    
                                                    <div class="progress">
                                                        <div class="progress-bar progress-bar-striped progress-bar-animated bg-warning"
                                                            role="progressbar" style="width: 100%" aria-valuenow="100"
                                                            aria-valuemin="0" aria-valuemax="100">Proses...</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
    
                                    @elseif ($pesan->status_kursus == 'FAILED')
                                    <div class="col mt-2 progress">
                                        <div class="progress-bar progress-bar-striped progress-bar-animated bg-danger"
                                            role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0"
                                            aria-valuemax="100">Bukti Transfer Gagal...</div>
                                    </div>
                                    <div class="alert alert-info mt-3">
                                        <h4 class="alert-heading">Perhatikan!</h4>
                                        <hr>
                                        <p class="mb-0">
                                            <ol type="1">
                                                <li>No. rekening tujuan</li>
                                                <li>Jumlah tagihan anda sebesar @currency($pesan->total_tagihan).00
                                                </li>
                                            </ol>
                                        </p>
                                    </div>
                                    <form action="{{ route('order.patch.pembayaran') }}" method="POST"
                                        enctype="multipart/form-data" class="pr-xl-3">
                                        @csrf
                                        @method('patch')
                                        <div class="mb-4">
                                            <label for="form_search" class="form-label">Silahkan upload ulang
                                                bukti transfer</label>
                                            <div class="input-label-absolute input-label-absolute-right">
                                                <input type="file" name="fileTransfer" class="form-control-file pr-4">
                                                <img class="img-target my-3" width="200px">
                                            </div>
                                        </div>
                                        <div class="pb-4">
                                            <div class="mb-4">
                                                <button type="submit" class="btn btn-primary btn-sm"> <i
                                                        class="far fa-paper-plane mr-1"></i>Update
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                    @endif
    
                                    @empty
                                    <div class="alert alert-warning col text-center mb-5 mt-3" role="alert">
                                        Data pesanan anda kosong, silahkan upload <strong>bukti transfer</strong> jika sudah
                                        mengambil kursus
                                    </div>
                                    @endforelse
    
                                </div>
                            </div>
                        </div>
                    </div>
    
                    {{-- Upload bukti transfer --}}
                    <div class="col">
    
                        {{-- @if ($order_status != null)
                        <div class="card">
                            <div class="card-body">
                                <div class="alert alert-info col" role="alert">
                                    Silahkan menunggu konfirmasi pesanan terlebih dahulu untuk upload <strong>bukti
                                        transfer</strong>
                                </div>
                            </div>
                        </div>
                        @endif --}}
    
                        @if ($order_status < 1)
                        <div class="card shadow">
                            <div class="card-body">
                                <span>Upload Bukti Transfer :</span>
                                <span class="float-right h5"></span>
                                <hr>
                                <form action="{{ route('order.post.pembayaran') }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <input type="file" name="upload_bukti_transfer"
                                        class="form-control-file pr-4 @error('upload_bukti_transfer') is-invalid @enderror">
                                    @error('upload_bukti_transfer')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                    <img class="img-target my-3" width="200px">
                                    <br>
                                    <button type="submit" class="btn btn-primary float-right btn-md">Kirim</button>
                                </form>
    
                            </div> <!-- card-body.// -->
                        </div> <!-- card .// -->
                        @endif
                    </div>
    
                </div>
            </div>
    
            <!-- Pagination -->
            <nav aria-label="Page navigation example">
                <ul class="pagination pagination-template d-flex justify-content-center">
                    {{ $order_kursus->links() }}
                </ul>
            </nav>
        </div>
    </section>

    @include('web.layouts.footer')

    @include('web.layouts.script')

    <script>
        $(function () {
            $('[data-toggle="tooltip"]').tooltip()
        })
    </script>

    <script>
        $(document).ready(function () {
            var readURL = function (input) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();

                    reader.onload = function (e) {
                        $('.img-target').attr('src', e.target.result);
                    }
                    reader.readAsDataURL(input.files[0]);
                }
            }

            $(".form-control-file").on('change', function () {
                readURL(this);
            });
        });

    </script>
    
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

            // function delete cart
            $("#deleteCart").on("click", function (e) {
                var nama = $(this).data('id');

                // sweealert 
                swal({
                        title: "Yakin ?",
                        text: "mau dihapus order ini dengan kursus " + nama + " ",
                        icon: "warning",
                        buttons: true,
                        dangerMode: true,
                    })
                    .then((willDelete) => {
                        if (willDelete) {
                            e.preventDefault();
                            var id = $(this).data("id");
                            var token = $("meta[name='csrf-token']").attr("content");

                            $.ajax({
                                url: "/order/cart/" + id,
                                type: 'DELETE',
                                data: {
                                    _token: token,
                                    id: id
                                },
                                success: function (response) {
                                    toastr.options.closeButton = true;
                                    toastr.options.closeMethod = 'fadeOut';
                                    toastr.options.closeDuration = 100;
                                    toastr.warning(response.message);

                                    document.getElementById("total").textContent = response
                                        .totalTagihan;
                                    setTimeout(function () {
                                        location.reload();
                                    }, 1500);
                                }
                            });

                        } else {
                            // swal("Your imaginary file is safe!");
                        }
                    });
                return false;
            });

            // function delete checkout
            $("#deleteCheckout").on("click", function (e) {
                // sweealert 
                swal({
                        title: "Yakin ?",
                        text: "Membatalkan konfirmasi.",
                        icon: "warning",
                        buttons: true,
                        dangerMode: true,
                    })
                    .then((willDelete) => {

                        if (willDelete) {

                            e.preventDefault();
                            var id = $(this).data("id");
                            var token = $("meta[name='csrf-token']").attr("content");

                            $.ajax({
                                url: "/order/checkout/" + id,
                                type: 'PATCH',
                                data: {
                                    _token: token,
                                },
                                success: function (response) {
                                    setTimeout(function () {
                                        location.reload();
                                    }, 1500);
                                }
                            });

                        } else {
                            // swal("Your imaginary file is safe!");
                        }
                    });

                return false;
            });

            
        });
        
    </script>

</body>

</html>