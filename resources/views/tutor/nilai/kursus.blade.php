@extends('admin.layouts.tutor')

@section('title','Bimble - Data Nilai')
@section('content')
<div class="orders">
    <div class="row">
        <div class="col-12">

            <div class="card">

                <div class="card-body">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    @if ($message = Session::get('success'))
                        <div class="toast" id="myToast" style="position: absolute; top: 0; right: 0;">
                            <div class="toast-header">
                                <strong class="mr-auto"><i class="fa fa-warning"></i> Pemberitahuan!</strong>
                                
                                <button type="button" class="ml-2 mb-1 close" data-dismiss="toast">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="toast-body">
                                <div>{{ $message }}</div>
                            </div>
                        </div>
                    @endif
                    
                    @if ($message = Session::get('failed'))
                        <div class="toast" id="myToast" style="position: absolute; top: 0; right: 0;">
                            <div class="toast-header">
                                <strong class="mr-auto"><i class="fa fa-warning"></i> Pemberitahuan!</strong>
                                
                                <button type="button" class="ml-2 mb-1 close" data-dismiss="toast">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="toast-body">
                                <div>{{ $message }}</div>
                            </div>
                        </div>                        
                    @endif

                    <h4 class="box-title">Daftar Nilai Kursus {{ $kursus->nama_kursus }}</h4>
                        
                    {{-- <form action="{{route('siswa.index')}}">

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
                    </form> --}}
                </div>
                <div class="card-body--">

                    {{-- <a class="btn btn-primary btn-sm ml-3 mb-3" href="{{ route('nilai.create') }}"> <i
                            class="fa fa-plus" aria-hidden="true"></i> </a> --}}
                    {{-- <div class="table-stats order-table ov-h">
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
                    </div> --}}

                    <div class="accordion" id="accordionExample">
                        <div class="card">
                            <div class="card-header" id="headingOne">
                            <h2 class="mb-0">
                                <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                Siswa
                                </button>
                            </h2>
                            </div>
                        
                            <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
                            <div class="card-body">
                                <table class="table table-sm">
                                    <thead>
                                        <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Nama</th>
                                        <th scope="col">Alamat</th>
                                        <th scope="col">Nilai</th>
                                        <th scope="col">Keterangan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($siswa as $siswa)
                                        <tr>
                                        <th scope="row">{{ $loop->iteration }}</th>
                                        <td>{{ $siswa->nama_siswa }}</td>
                                        <td>{{ $siswa->alamat }}</td>
                                        <td>
                                            <form id="inputNilai" action="/tutor/nilai/{{ $siswa->id }}" method="post">
                                                @csrf @method('put')
                                                <input type="text" name="nilai" id="nilai" onsubmit="submitform()" value="{{ !empty($siswa->nilai)?$siswa->nilai:'' }}" class="text-center col-sm-4 form-control">
                                            </form>
                                        </td>
                                        <td>{{ $siswa->keterangan }}</td>
                                        </tr>
                                            
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header" id="headingTwo">
                            <h2 class="mb-0">
                                <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                Pendaftar
                                </button>
                            </h2>
                            </div>
                            <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
                            <div class="card-body">
                                <table class="table table-sm">
                                    <thead>
                                        <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Nama</th>
                                        <th scope="col">Alamat</th>
                                        <th scope="col">Nilai</th>
                                        <th scope="col">Keterangan</th>
                                        <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($order_detail as $order_detail)
                                            @foreach ($order_detail->pendaftar as $pendaftar)
                                            <tr>
                                            <th scope="row"></th>
                                            <td>{{ $pendaftar->nama_pendaftar }}</td>
                                            <td>{{ $pendaftar->alamat }}</td>
                                            @if(isset($pendaftar->nilai->nilai))
                                                <td>{{ $pendaftar->nilai->nilai }}</td>
                                                <td>{{ $pendaftar->nilai->keterangan }}</td> 
                                                <td>
                                                    <a href="/tutor/nilai/{{ $pendaftar->nilai->id }}/edit" class="btn btn-success btn-sm ml-3 mb-3"> <i
                                                    class="fa fa-pencil" aria-hidden="true"></i> </a>
                                                </td>
                                            @else
                                                <form action="{{ route('nilai.store') }}" method="post">
                                                    @csrf
                                                    <input type="hidden" name="idPendaftar" value="{{ $pendaftar->id }}">
                                                    <input type="hidden" name="idKursus" value="{{ $order_detail->id_kursus }}">
                                                    <td><input type="text" name="nilai" id="nilai" class="text-center col-sm-4 form-control" placeholder="-"></td>
                                                    <td><input type="text" name="keterangan" id="keterangan" class="text-center col-sm-4 form-control" placeholder="-"></td> 
                                                    <td>
                                                        <button type="submit" id="btn_nilai_pendaftar" class="btn btn-primary btn-sm ml-3 mb-3"> <i
                                                        class="fa fa-plus" aria-hidden="true"></i> </button>
                                                    </td>
                                                </form>
                                            @endif                                                                                              
                                            
                                            </tr>
                                                
                                            @endforeach                                            
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function submitform()
    {
        document.getElementById("inputNilai").submit();
    }

    $('.toast').toast({})
</script>

@endsection
