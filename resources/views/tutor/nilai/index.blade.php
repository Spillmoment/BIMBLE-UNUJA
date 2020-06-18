@extends('admin.layouts.tutor')

@section('title','Bimble - Data Nilai')
@section('content')
<div class="orders">
    <div class="row">
        <div class="col-12">

            <div class="card">

                <div class="card-body">

                    <h4 class="box-title">Daftar Nilai</h4>

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
                                <a href="{{ route('nilai.index') }}" class="btn btn-warning text-light ml-2"> <i
                                        class="fa fa-refresh" aria-hidden="true"></i> </a>
                            </div>

                        </div>
                    </form>
                </div>
                <div class="card-body--">

                    <a class="btn btn-primary btn-sm ml-3 mb-3" href="{{ route('nilai.create') }}"> <i
                            class="fa fa-plus" aria-hidden="true"></i> </a>
                    <div class="table-stats order-table ov-h">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Jenis Kelamin</th>
                                    <th>Kursus</th>
                                    <th>Nilai</th>
                                    <th>Keterangan</th>
                                    <th>Option</th>
                                </tr>
                            </thead>

                            <tbody>
                                @forelse ($nilai as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        @foreach ($item->pendaftar as $user)
                                        {{ $user->nama_pendaftar }}
                                        @endforeach
                                    </td>
                                    <td>
                                        @if ($user->jenis_kelamin == 'L')
                                        Laki-Laki
                                        @else
                                        Perempuan
                                        @endif
                                    </td>
                                    <td>
                                        @foreach ($item->kursus as $cours)
                                        {{ $cours->nama_kursus }}
                                        @endforeach
                                    </td>
                                    <td>{{ $item->nilai }}.0</td>
                                    <td>{{ $item->keterangan }}</td>
                                    <td>
                                        TODO: actions
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
