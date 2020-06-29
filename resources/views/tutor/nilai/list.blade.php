@extends('admin.layouts.tutor')
@section('title','Bimble - Data Nilai')

@section('content')

<div class="breadcrumbs">
  <div class="breadcrumbs-inner">
      <div class="row m-0">
          <div class="col-sm-4">
              <div class="page-header float-left">
                  <div class="page-title">
                      <h1>Data Nilai </h1>
                  </div>
              </div>
          </div>
          <div class="col-sm-8">
              <div class="page-header float-right">
                  <div class="page-title">
                      <ol class="breadcrumb text-right">
                          <li><a href="{{ route('nilai.index') }}">Data Nilai</a></li>
                          <li class="active">List Nilai </li>
                      </ol>
                  </div>
              </div>
          </div>
      </div>
  </div>
</div>

<div class="content">
  <div class="animated fadeIn">
      <div class="row">
          <div class="col-md-12">
              <div class="card">
                  <div class="card-header">
                      <strong class="card-title">Table Nilai</strong>

                      {{-- <a class="btn btn-primary btn-sm float-right" href="{{ route('nilai.create') }}"> <i
                              class="fa fa-plus" aria-hidden="true"></i> Add Nilai</a> --}}
                  </div>
                  <div class="card-body">
                      <table id="bootstrap-data-table" class="table table-striped table-bordered">
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
  </div><!-- .animated -->
</div>


@endsection

@push('after-script')
@include('admin.includes.datatable')
<script>
    $('button#deleteButton').on('click', function (e) {
        var name = $(this).data('name');
        e.preventDefault();
        swal({
                title: "Yakin!",
                text: "menghapus kategori  " + name + "?",
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