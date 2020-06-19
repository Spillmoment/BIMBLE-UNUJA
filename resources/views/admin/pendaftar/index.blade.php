@extends('admin.layouts.manager')

@section('title','Bimble - Data Pendaftar')
@section('content')
<div class="orders">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="box-title">List Pendaftar</h4>

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

                    <form action="{{route('pendaftar.index')}}">

                        <div class="row mt-2">

                            <div class="col-md-5 col-xs-5">
                                <div class="form-group">
                                    <input type="text" class="form-control" {{ Request::get('keyword') }} name="keyword"
                                        placeholder="Masukkan Nama" autofocus>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <button type="submit" class="btn btn-secondary"> <i class="fa fa-search"
                                        aria-hidden="true"></i> </button>
                                <a href="{{ route('pendaftar.index') }}" class="btn btn-warning text-light ml-2"> <i
                                        class="fa fa-refresh" aria-hidden="true"></i> </a>
                            </div>

                        </div>
                    </form>
                </div>
                <div class="card-body--">


                    <div class="table-stats order-table ov-h">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Pendaftar</th>
                                    <th>Jenis Kelamin</th>
                                    <th>Alamat</th>
                                    <th>Foto</th>
                                    <th>Status</th>
                                    <th>Option</th>
                                </tr>
                            </thead>
                            <tbody>


                                @if ($pendaftar->count() > 0)
                                @foreach ($pendaftar as $regis)
                                <tr>
                                    <td scope="row"> {{$loop->iteration}} </td>
                                    <td>{{ $regis->nama_pendaftar }}</td>
                                    @if ($regis->jenis_kelamin == 'L')
                                    <td>Laki-Laki</td>
                                    @else
                                    <td>Perempuan</td>
                                    @endif
                                    <td>{{ $regis->alamat }}</td>

                                    <td>
                                        @if($regis->foto)
                                        <img src="{{ Storage::url('uploads/pendaftar/profile/'.$regis->foto) }}"
                                            width="50px">
                                        @else
                                        N/A
                                        @endif
                                    </td>

                                    <td>
                                        @if($regis->status == 1)
                                        <span class="badge badge-success">
                                            Aktif
                                        </span>
                                        @else
                                        <span class="badge badge-danger">
                                            Nonaktif
                                        </span>
                                        @endif
                                    </td>
                                    <td>
                                        <a class="btn btn-info text-white btn-sm" href="{{route('pendaftar.show',
                                       [$regis->id])}}"> <i class="fa fa-eye"></i></a>

                                        <form onsubmit="return confirm('yakin untuk memasukkan ke Trash!')"
                                            class="d-inline" action="{{route('pendaftar.destroy', [$regis->id])}}"
                                            method="POST">
                                            @method('DELETE')
                                            @csrf
                                            <button type="submit" value="Delete" class="btn btn-danger btn-sm">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        </form>
                                    </td>

                                </tr>
                                @endforeach
                                @else
                                <tr>
                                    <td>
                                        <h5>Data Kosong</h5>
                                    </td>
                                </tr>
                                @endif
                            </tbody>

                        </table>

                        <div class="text-center">
                            {{ $pendaftar->links() }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
