@extends('admin.layouts.tutor')

@section('title','Bimble - Data Siswa')
@section('content')
<div class="orders">
    <div class="row">
        <div class="col-12">

            <div class="card">

                <div class="card-body">

                    <h4 class="box-title">Daftar Siswa</h4>

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

                    <form action="{{route('siswa.index')}}">

                        <div class="row mt-2">

                            <div class="col-md-5">
                                <div class="form-group">
                                    <input type="text" class="form-control" {{ Request::get('keyword') }} name="keyword"
                                        placeholder="Masukkan Nama Siswa" autofocus>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <button type="submit" class="btn btn-secondary"> <i class="fa fa-search"
                                        aria-hidden="true"></i> </button>
                                <a href="{{ route('siswa.index') }}" class="btn btn-warning text-light ml-2"> <i
                                        class="fa fa-refresh" aria-hidden="true"></i> </a>
                            </div>

                        </div>
                    </form>
                </div>
                <div class="card-body--">

                    <a class="btn btn-primary btn-sm ml-3 mb-3" href="{{ route('siswa.create') }}"> <i
                            class="fa fa-plus" aria-hidden="true"></i> </a>
                    <div class="table-stats order-table ov-h">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Siswa</th>
                                    <th>Jenis Kelamin</th>
                                    <th>Alamat</th>
                                    <th>Foto</th>
                                    <th>Option</th>
                                </tr>
                            </thead>

                            <tbody>
                                @forelse ($siswa as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td> {{ $item->nama_siswa }} </td>
                                    <td>
                                        @if ($item->jenis_kelamin == 'L')
                                        Laki-Laki
                                        @else
                                        Perempuan
                                        @endif
                                    </td>
                                    <td> {{ $item->alamat }} </td>
                                    <td>
                                        @if ($item->foto)
                                        <img src="{{ asset('uploads/siswa/'.$item->foto) }}"
                                            alt="{{ $item->nama_siswa }}">
                                        @else
                                        N/A
                                        @endif
                                    </td>
                                    <td>
                                        <a class="btn btn-success text-white btn-sm" href="{{route('siswa.nilai',
                         [$item->id])}}"> <i class="fa fa-download"></i></a>
                                        <a class="btn btn-info text-white btn-sm" href="{{route('siswa.show',
                         [$item->id])}}"> <i class="fa fa-eye"></i></a>
                                        <a class="btn btn-warning text-white btn-sm" href="{{route('siswa.edit',
                            [$item->id])}}"> <i class="fa fa-edit"></i> </a>
                                        <form onsubmit="return confirm('yakin untuk memasukkan ke Trash!')"
                                            class="d-inline" action="{{route('siswa.destroy', [$item->id])}}"
                                            method="POST">
                                            @method('DELETE')
                                            @csrf
                                            <button type="submit" value="Delete" class="btn btn-danger btn-sm">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td>Data Siswa Kosong</td>
                                </tr>
                                @endforelse
                            </tbody>

                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection
