@extends('admin.layouts.tutor')

@section('title','Bimble - Detail Siswa')
@section('content')
<div class="orders">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="box-title">Detail Siswa
                        <span class="badge badge-primary badge-pill badge-lg" style="font-size: 15px;">
                            {{ $siswa->nama_siswa }}
                        </span>
                    </h4>
                    <table class="table table-bordered table-striped table-hover mt-2">

                        <tr>
                            <th>ID</th>
                            <td>{{ $siswa->id }}</td>
                        </tr>
                        <tr>
                            <th>Nama Siswa </th>
                            <td>{{ $siswa->nama_siswa }}</td>
                        </tr>

                        <tr>
                            <th>Username</th>
                            <td>{{ $siswa->username }}</td>
                        </tr>
                        <tr>
                            <th>Jenis Kelamin</th>

                            @if ($siswa->jenis_kelamin == 'L')
                            <td>Laki-Laki</td>
                            @else
                            <td>Perempuan</td>
                            @endif
                        </tr>
                        <tr>
                            <th>Alamat</th>
                            <td>{{ $siswa->alamat }}</td>
                        </tr>

                        <tr>
                            <th>Foto</th>
                            <td>
                                <img src="{{ asset('uploads/siswa/' . $siswa->foto) }}" alt=""
                                    class="img-thumbnail mb-2" width="150px">
                                <br>
                                <button type="submit" class="badge badge-primary" data-toggle="modal"
                                    data-target="#modelId">
                                    <i class="fa fa-eye    "></i> Show Images</button>
                            </td>
                        </tr>

                        <tr>
                            <th>Nilai</th>
                            @if ($siswa->nilai > 0)
                            <td>
                                {{ $siswa->nilai }}
                            </td>
                            @else
                            <td><span class="badge badge-warning text-light">Nilai belum ada</span></td>
                            @endif
                        </tr>

                        <tr>
                            <th>Keterangan</th>
                            <td>{{ $siswa->keterangan }}</td>
                        </tr>

                    </table>
                </div>
            </div>

        </div>
    </div>
</div>
</div>


<!-- Modal -->
<div class="modal fade" id="modelId" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><span class="badge badge-light badge-pill badge-lg" style="font-size: 15px;">
                        Foto Siswa {{ $siswa->nama_siswa }}
                    </span></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <img src="{{ asset('uploads/siswa/' . $siswa->foto) }}" alt="" class="img-thumbnail" height="200px">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>

            </div>
        </div>
    </div>
</div>

@endsection
