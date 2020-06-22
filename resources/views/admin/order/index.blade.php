@extends('admin.layouts.manager')

@section('title','Bimble - Data Order')
@section('content')

<div class="breadcrumbs">
    <div class="breadcrumbs-inner">
        <div class="row m-0">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1>Data Order</h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
                            <li><a href="{{ route('order.index') }}">Data Order</a></li>
                            <li class="active">List Order </li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@if(session('status'))
@push('after-script')
<script>
    swal({
        title: "Success",
        text: "{{session('status')}}",
        icon: "success",
        button: false,
        timer: 2000
    });

</script>
@endpush
@endif

<div class="content">
    <div class="animated fadeIn">


        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <strong class="card-title">Table Order</strong>

                        <form action="{{ route('order.index') }}" method="get">
                            <div class="row">
                                <div class="col">

                                    <label class="mt-3">Pencarian Tanggal Order</label>
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <input type="date" name="start_date" placeholder="Start Date"
                                                    class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <input type="date" name="end_date" placeholder="End Date"
                                                    class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-sm-2">
                                            <button type="submit" class="btn btn-primary mt-1"> <i
                                                    class="fa fa-search"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>


                    </div>
                    <div class="card-body">

                        @if (Request::get('start_date') != "" && Request::get('end_date') != "")
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                <span class="sr-only">Close</span>
                            </button>
                            Hasil pencarian order masuk dari tanggal : <strong> {{ $start_date }} s/d {{ $end_date }}
                            </strong>
                        </div>
                        @endif

                        <table id="bootstrap-data-table" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nama</th>
                                    <th>Email</th>
                                    <th>Tanggal Order</th>
                                    <th>Total Order</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>

                                @forelse ($items as $item)
                                @if ($item->status_kursus != "CANCEL")

                                <tr>
                                    <td>{{ $item->id }}</td>
                                    @foreach ($item->pendaftar as $user)

                                    <td>{{ $user->nama_pendaftar }}</td>
                                    <td>{{ $user->email }}</td>
                                    @endforeach
                                    <td> {{ $item->created_at->format('d F Y') }}</td>
                                    <td>
                                        @currency($item->total_tagihan).00</td>
                                    <td>
                                        @if($item->status_kursus == 'PENDING')
                                        <span class="badge badge-info">
                                            @elseif($item->status_kursus == 'SUCCESS')
                                            <span class="badge badge-success">
                                                @elseif($item->status_kursus == 'FAILED')
                                                <span class="badge badge-warning">
                                                    @elseif($item->status_kursus == 'PROCESS')
                                                    <span class="badge badge-secondary">
                                                        @else
                                                        <span>
                                                            @endif
                                                            {{ $item->status_kursus }}
                                                        </span>
                                    </td>
                                    <td  style="width: 18%">
                                        @if($item->status_kursus == 'PENDING')
                                        <a href="{{ route('order.status', $item->id) }}?status=SUCCESS"
                                            class="btn btn-success btn-sm">
                                            <i class="fa fa-check"></i>
                                        </a>
                                        <a href="{{ route('order.status', $item->id) }}?status=FAILED"
                                            class="btn btn-warning btn-sm">
                                            <i class="fa fa-times"></i>
                                        </a>
                                        @endif
                                        <a href="#mymodal" data-remote="{{ route('order.show', $item->id) }}"
                                            data-toggle="modal" data-target="#mymodal"
                                            data-title="Detail Order {{ $user->nama_pendaftar }}"
                                            class="btn btn-info btn-sm">
                                            <i class="fa fa-eye"></i>
                                        </a>

                                        <form action="{{ route('order.destroy', $item->id) }}" method="post"
                                            class="d-inline">
                                            @csrf
                                            @method('delete')
                                            <button type="submit" class="btn btn-danger btn-sm" id="deleteButton"
                                                data-name="{{ $user->nama_pendaftar }}">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                @endif

                                @empty
                                @push('after-script')
                                <script>
                                    swal({
                                    title: "Maaf",
                                    text: "Data order kosong!",
                                    icon: "warning",
                                    button: "OK!",
                                    }).then(function() {
                                        window.location = "{{ route('order.index') }}";
                                    }, 3000);
                                </script>
                                    @endpush
                                @endforelse
                            </tbody>

                        </table>

                        <div class="float-right">
                            {{ $items->appends(Request::all())->links() }}
                        </div>
                    </div>
                </div>
            </div>


        </div>
    </div><!-- .animated -->
</div>


@endsection

@push('after-script')

<script>
    $('button#deleteButton').on('click', function (e) {
        var name = $(this).data('name');
        e.preventDefault();
        swal({
                title: "Yakin!",
                text: "menghapus Order  " + name + "?",
                icon: "warning",
                dangerMode: true,
                buttons: {
                    cancel: "Cancel",
                    confirm: "OK",
                },
            })
            .then((willDelete) => {
                if (willDelete) {
                    $(this).closest("form").submit();
                }
            });
    });

</script>
@endpush
